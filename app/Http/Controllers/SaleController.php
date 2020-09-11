<?php

namespace App\Http\Controllers;

use App\Models\ProductSale;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //

    public function  saleStore(Request $request){
//return $request->all();

      DB::beginTransaction();
    try{
        $sale = new Sale();
        $sale->invoice_no  = date("Ymd").date("his");
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
        if($request->due_amount>0){
            $sale->payment_status = 'Due';
        }else{
            $sale->payment_status = 'Paid';
        }
        $sale->paid_amount = $request->paid_amount;
        $sale->due_amount = $request->due_amount;
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
        }
        DB::commit();
        return "kaj hoice";

    }catch(\Exception $e){
        DB::rollBack();
        return $e->getMessage();
    }



    }
}
