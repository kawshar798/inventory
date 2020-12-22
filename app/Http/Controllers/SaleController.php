<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ProductSaleReturn;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class SaleController extends Controller
{
    //
        protected $path;

        public  function  __construct()
        {
            $this->path = 'sale.';
        }

        public function  saleList(){
            $sales = Sale::all();
            return view($this->path.'sale_list',compact('sales'));
        }

    public function  saleStore(Request $request){
      DB::beginTransaction();
    try{
        $sale = new Sale();
        $sale->invoice_no  = date("Ymd").date("hi");
        $sale->biller_id   = Auth::id();
        $sale->customer_id = $request->customer_id;
        $sale->item = $request->in_item;
        $sale->total_qty = $request->total_qty;
        $sale->total_discount = $request->total_discount;
        $sale->total_tax = $request->total_tax;
        $sale->total_price = $request->total_price;
        $sale->grand_total = $request->grand_total;
        $sale->coupon_discount = $request->coupon_discount;
        $sale->shipping_cost = $request->shipping_cost;
        $sale->return_amount = $request->in_return_amount;
        if($request->due_amount>0){
            $sale->payment_status = 'Due';
        }else{
            $sale->payment_status = 'Paid';
        }
        $sale->paid_amount = $request->paid_amount;

        if($request->paid_amount >= $request->grand_total){
            $sale->due_amount = 0;
        }else{
            $sale->due_amount = $request->due_amount;
        }

        if($sale->save()){
           $productProId =  $request->proId;
           $productQty =  $request->proQuantity;
           $productPrice =  $request->proPrice;
           foreach ($productProId as $i =>$item){
               $productSale = new ProductSale();
               $productSale->sale_id = $sale->id;
               $productSale->product_id = $item;
               $productSale->qty = $productQty[$i];
               $productSale->unit_price = $productPrice[$i];
               $productSale->discount = 0;
               $productSale->total = $productQty[$i] * $productPrice[$i];
               $productSale->save();

               $product = Product::where('id',$item)->first();
               $product->quantity = $product->quantity - $productQty[$i];
               $product->save();
           }
                $payment = new Payment();
                $payment->sale_id = $sale->id;
                $payment->payment_reference = 'PS.' . date("Ymd") . '/'. date("hi");
                $payment->user_id = Auth::id();
                $payment->cheque_number = $request->cheque_number;
                $payment->amount = $request->paid_amount;
                $payment->paying_method = 'Cash';
                $payment->note = $request->note;
                $payment->save();

        }
        DB::commit();
        return redirect('sale/invoice?invoice_no='.$sale->invoice_no);

    }catch(\Exception $e){
        DB::rollBack();
        return $e->getMessage();
    }
    }

    public  function  saleInvoice(Request $request){
            $sale = Sale::where('invoice_no',$request->invoice_no)->first();
        return view($this->path.'invoice',compact('sale'));
    }
    public function  show($id){
        $sale = Sale::where('id',$id)->first();
        return view($this->path.'show',compact('sale'));
    }
    public function  addPayment(Request $request){
        $sale = Sale::where('id',$request->id)->first();
        try{
            $sale->paid_amount += $request->amount;
            $balance =   $sale->grand_total - $sale->paid_amount;
            $sale->due_amount =  $balance;
            if($balance > 0){
                $sale->payment_status = 'Due';
            }else{
                $sale->payment_status = 'Paid';
            }
            $sale->save();
            if($request->payment_id){
                $payment =  Payment::where('id',$request->payment_id)->first();
            }else{
                $payment = new Payment();
            }
            $payment->sale_id = $sale->id;
            if($payment->payment_reference){
                $payment->payment_reference =  $payment->payment_reference;
            }else{
                $payment->payment_reference = 'PS' . date("Ymd") . '/'. date("hi");
            }
            $payment->user_id = Auth::id();
            $payment->cheque_number = $request->cheque_number;
            $payment->amount = $request->amount;
            $payment->paying_method = $request->paying_method;
            $payment->note = $request->note;

            $payment->save();
            DB::commit();
            if($request->payment_id){
                $output = ['success' => true,
                    'messege'            => "Payment  Update  success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Payment   success",
                ];
            }

            return $output;
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function  viewPayment($id){
        $sale = Sale::find($id);
        $payments = Payment::where('sale_id',$id)->get();
        return view($this->path.'payment_list',compact('payments','sale'));
    }

    public  function  delete($id){
        $sale  = Sale::find($id);
        $sales_products  =  ProductSale::where('sale_id',$sale->id)->get();
        foreach ($sales_products as $productPurcahse){
            $productPurcahse->delete();
        }
        $payments = Payment::where('sale_id',$sale->id)->get();
        foreach ($payments as $payment){
            $payment->delete();
        }
        $sale->delete();
        $output = ['success' => true,
            'messege'            => "Sale Product Delete  success",
        ];
        return $output;
    }

    public  function  saleReturnView(){
        $customers = Customer::all();
        $products = Product::all();
        return view($this->path.'sale_return',compact('customers','products'));
        }
        public  function  saleReturnProductEdit($id){
            $returnProduct = SaleReturn::where('id',$id)->first();
            $customers = Customer::all();
            $products = Product::all();
            $product_sale_returns = ProductSaleReturn::where('sale_return_id',$id)->get();
            return view($this->path.'sale_return_edit',compact('customers','products','returnProduct','product_sale_returns'));
        }

        public  function  getSingleProduct(Request $request,$id){
           $data['product']= Product::where('id',$id)->first();
            if ($request->ajax()) return Response::json(View::make('sale.sale_return_product_list', $data)->render());
        }

        public  function  saleReturnProductStore(Request $request){
           DB::beginTransaction();
           try{

               $sale_return  = new SaleReturn();
               $sale_return->customer_id             = $request->customer_id;
               $sale_return->reference_no            = date("Ymd").date("hi");
               $sale_return->item                    = $request->in_item;
               $sale_return->sale_invoice_no         = $request->invoice_number;
               $sale_return->total_qty               = $request->in_total_qty;
               $sale_return->total_price             = $request->in_total_cost;
               $sale_return->grand_total             = $request->in_grand_total;
//               $sale_return->date  = $request->customer_id;
               $sale_return->return_note             = $request->description;
               $sale_return->save();


               $product_id    = $request->proId;
               $product_qty   = $request->proQuantity;
               $product_price = $request->prosubTotal;
               foreach ($product_id as $i=>$item){
                   $product_sale_return = new ProductSaleReturn();
                   $product_sale_return->sale_return_id = $sale_return->id;
                   $product_sale_return->product_id = $item;
                   $product_sale_return->qty = $product_qty[$i];
                   $product_sale_return->unit_price = $product_price[$i];
                   $product_sale_return->save();

                   $product = Product::where('id',$product_id[$i])->first();
                   $product->quantity = $product->quantity + $product_qty[$i];
                   $product->save();
               }

               $sale = Sale::where('invoice_no',$request->invoice_number)->first();
               $sale->return_amount = $request->in_grand_total;
               $sale->save();
               DB::commit();
               $output = ['success' => true,
                   'messege'            => "Product Active success",
               ];
               return redirect()->route('purchase.index')->with($output);
           }catch (\Exception $e){
               DB::rollBack();
               return $e->getMessage();
           }
        }

        public  function  saleReturnProductList(){
            $products = SaleReturn::all();
            return view($this->path.'sale_return_all_product',compact('products'));
        }
        public  function  saleReturnProductView($id){
            $return_product = SaleReturn::find($id);
            return view($this->path.'sale_return_product_show',compact('return_product'));
        }
    public  function  saleReturnProductUpdate(Request $request){
        DB::beginTransaction();
        try{

            $sale_return  = SaleReturn::where('id',$request->return_product_id)->first();
            $sale_return->customer_id  = $request->customer_id;
//            $sale_return->reference_no  = date("Ymd").date("hi");
            $sale_return->item         = $request->in_item;
            $sale_return->total_qty    = $request->in_total_qty;
            $sale_return->total_price  = $request->in_total_cost;
            $sale_return->grand_total  = $request->in_grand_total;
//               $sale_return->date  = $request->customer_id;
            $sale_return->return_note  = $request->description;
            $sale_return->save();


            $product_id    = $request->proId;
            $sale_return_id    = $request->product_sale_returns;
            $product_qty   = $request->proQuantity;
            $product_price = $request->prosubTotal;
            foreach ($product_id as $i=>$item){
                $product_sale_return = ProductSaleReturn::where('id',$sale_return_id[$i])->first();
                $product_sale_return->sale_return_id = $sale_return->id;
                $product_sale_return->product_id = $item;
                $product_sale_return->qty = $product_qty[$i];
                $product_sale_return->unit_price = $product_price[$i];
                $product_sale_return->save();

                $product = Product::where('id',$product_id[$i])->first();
                $product->quantity = $product->quantity + $product_qty[$i];
                $product->save();
            }

            $sale = Sale::where('invoice_no',$sale_return->sale_invoice_no)->first();
            $sale->return_amount = $request->in_grand_total;
            $sale->save();
            DB::commit();
            $output = ['success' => true,
                'messege'            => "Product Active success",
            ];
            return redirect()->route('purchase.index')->with($output);
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
        public  function  saleSinReturnProductDelete($id){
            $product = ProductSaleReturn::find($id);
            $product->delete();
            return  "success";

        }
        public  function  saleReturnProductDelete($id){
            $product = SaleReturn::find($id);
            $sale_return_product = ProductSaleReturn::where('sale_return_id',$product->id)->get();
            foreach ($sale_return_product as $i=>$item){
                $item->delete();
            }
            $product->delete();
            $output = ['success' => true,
                'messege'            => "Product Active success",
            ];
            return  $output;

        }


}
