<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    //

    public  function  __construct()
    {
        $this->path = 'purchase.';

    }
    public function  index(){
       $purchases = Purchase::all();
        return view($this->path.'index',compact('purchases'));

    }
    public function  create(){
        $suppliers = Supplier::where('status','Active')->get();
        $products = Product::where('status','Active')->get();
        $taxes = TaxRate::where('status','Active')->get();
        return view($this->path.'create',compact('suppliers','products','taxes'));

    }
    public function  store(Request $request){
//        return $request->proId;
        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->reference_no ='pp' . date("Ymd") . '00'. date("his");
        $purchase->item = $request->in_item;
        $purchase->total_qty = $request->in_total_qty;
        $purchase->order_tax = $request->in_total_tax;
        $purchase->total_cost = $request->in_total_cost;
        $purchase->order_discount = $request->in_order_discount;
        $purchase->shipping_cost = $request->in_shipping_cost;
        $purchase->grand_total = $request->in_grand_total;
        $purchase->paid_amount = $request->in_paid_amount;
        $purchase->status = $request->status;
        $purchase->note = $request->note;
        $balance = $request->in_grand_total -  $purchase->grand_total;
        if ($balance < 0 || $balance > 0) {
            $purchase->payment_status = 1;
        } else {
            $purchase->payment_status = 2;
        }
        if ($request->hasfile('receipt')) {
            $image = $request->document;
            $extension = $image->getClientOriginalExtension();
            $image_name = Str::slug($request->name) . "-" . time() . "." . $extension;
            $path = 'public/images/receipt/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->move($path, $image_name);
            $purchase->receipt = $path . $image_name;
        }
        $purchase->created_by = Auth::id();
        $purchase->save();
        $product_id = $request->proId;
        $proQuantity = $request->proQuantity;
        $prosubTotal = $request->prosubTotal;

           foreach ($product_id as $i => $item){
           $product_purchase =   new ProductPurchase();
           $product_purchase->product_id =   $item;
           $product_purchase->purchase_id =   $purchase->id;
           $product_purchase->qty =   $proQuantity[$i];
           $product_purchase->sub_total =   $prosubTotal[$i];
           $product_purchase->save();

        $product = Product::where('id',$product_id)->first();
        $product->quantity = $product->quantity + $proQuantity[$i];
        $product->save();
        }
        $output = ['success' => true,
            'messege'            => "Product Active success",
        ];

        return redirect()->route('purchase.index')->with($output);
    }

}
