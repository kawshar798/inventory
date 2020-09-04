<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $purchase->reference_no ='PP' . date("Ymd") . '/'. date("his");
//        $purchase->reference_no ='PP' . date("Ymd") . '/'. date("his");
        $purchase->item = $request->in_item;
        $purchase->total_qty = $request->in_total_qty;
        $purchase->order_tax = $request->in_total_tax;
        $purchase->total_cost = $request->in_total_cost;
        $purchase->order_discount = $request->in_order_discount;
        $purchase->shipping_cost = $request->in_shipping_cost;
        $purchase->grand_total = $request->in_grand_total;
        $purchase->paid_amount = $request->in_paid_amount;
        $purchase->status = $request->status;
        $purchase->date = $request->date;
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
        if( $purchase->save()){
            $payment = new Payment();
            $payment->purchase_id = $purchase->id;
            $payment->payment_reference = 'PP' . date("Ymd") . '/'. date("his");
            $payment->user_id = Auth::id();
            $payment->cheque_number = $request->cheque_number;
            $payment->amount = $request->paid_amount;
            $payment->paying_method = $request->paying_method;
            $payment->note = $request->note;
            $payment->save();
        }
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
public function  edit($id){
    $purchase  = Purchase::find($id);
}
    public function  show($id){
            $purchase = Purchase::where('id',$id)->first();
        return view($this->path.'show',compact('purchase'));
    }

    public function  addPayment(Request $request){
        $purchase = Purchase::where('id',$request->id)->first();
      try{
          $purchase->paid_amount += $request->amount;
          $balance =   $purchase->grand_total - $purchase->paid_amount;
          if ($balance <= 0 ) {
              $purchase->payment_status = 1;
          } else {
              $purchase->payment_status = 2;
          }
          $purchase->save();
          $payment = new Payment();
          $payment->purchase_id = $purchase->id;
          $payment->payment_reference = 'PP' . date("Ymd") . '/'. date("his");
          $payment->user_id = Auth::id();
          $payment->cheque_number = $request->cheque_number;
          $payment->amount = $request->amount;
          $payment->paying_method = $request->paying_method;
          $payment->note = $request->note;
          $payment->save();
          DB::commit();
          $output = ['success' => true,
              'messege'            => "Payment   success",
          ];
          return $output;
      }catch (\Exception $e){
          DB::rollBack();
          return $e->getMessage();
      }


    }

    public function  viewPayment($id){
        $purchase = Purchase::find($id);
        $payments = Payment::where('purchase_id',$id)->get();
          return view($this->path.'payment_list',compact('payments','purchase'));
    }

    public  function  delete($id){
        $purchase  = Purchase::find($id);
       $purchase_products  =  ProductPurchase::where('purchase_id',$purchase->id)->get();
       foreach ($purchase_products as $productPurcahse){
           $product = Product::where('id',$productPurcahse->product_id)->first();
           $product->quantity -= $productPurcahse->qty;
           $product->save();
           $productPurcahse->delete();
       }
       $payments = Payment::where('purchase_id',$purchase->id)->get();
        foreach ($payments as $payment){
            $payment->delete();
        }
        $purchase->delete();
        $output = ['success' => true,
            'messege'            => "Purchase Delete  success",
        ];
        return $output;
    }
}
