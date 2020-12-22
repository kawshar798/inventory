<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductPurchaseReturn;
use App\Models\ProductSaleReturn;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Models\Sale;
use App\Models\SaleReturn;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class PurchaseReturnController extends Controller
{

    protected $path;

    public  function  __construct()
    {
        $this->path = 'purchase.';
    }



//    Purchase return er modde purchase return e tu data dukbe shate
//    Product table er quantity theke data minus hobe

//"some quantites are returned from this purchase"-> this message show in main purchase list
//Add return_amount column  in main sale table

    public  function  returnView(){
        $suppliers = Supplier::all();
        $products = Product::all();
        return view($this->path.'return',compact('suppliers','products'));
    }
    public  function  returnProductEdit($id){
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

    public  function  returnProductStore(Request $request){
        DB::beginTransaction();
        try{

            $purchase_return = new PurchaseReturn();
            $purchase_return->supplier_id             = $request->supplier_id;
            $purchase_return->reference_no            = date("Ymd").date("hi");
            $purchase_return->item                    = $request->in_item;
//            $purchase_return->purchase_invoice_no         = $request->invoice_number;
            $purchase_return->total_qty               = $request->in_total_qty;
            $purchase_return->total_cost             = $request->in_total_cost;
            $purchase_return->grand_total             = $request->in_grand_total;
            $purchase_return->return_note             = $request->description;
            $purchase_return->save();


            $product_id    = $request->proId;
            $product_qty   = $request->proQuantity;
            $product_price = $request->prosubTotal;
            foreach ($product_id as $i=>$item){
                $product_pourchase_return = new ProductPurchaseReturn();
                $product_pourchase_return->purchase_return_id = $purchase_return->id;
                $product_pourchase_return->product_id = $item;
                $product_pourchase_return->qty = $product_qty[$i];
                $product_pourchase_return->unit_price = $product_price[$i];
                $product_pourchase_return->save();

                $product = Product::where('id',$product_id[$i])->first();
                $product->quantity = $product->quantity - $product_qty[$i];
                $product->save();
            }

            $purchase = Purchase::where('reference_no',$request->invoice_number)->first();
            $purchase->return_amount = $request->in_grand_total;
            $purchase->save();
            DB::commit();
            $output = ['success' => true,
                'messege'            => "Product Active success",
            ];
            return redirect()->route('purchase.return')->with($output);
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public  function  returnProductList(){
        $products = PurchaseReturn::all();
        return view($this->path.'return_all_product',compact('products'));
    }
    public  function  returnProductView($id){
        $return_product = PurchaseReturn::find($id);
        return view($this->path.'return_product_show',compact('return_product'));
    }
    public  function  returnProductUpdate(Request $request){
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
