<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ProductSale;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
