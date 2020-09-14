<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function  delete($id){
        $payment = Payment::find($id);
        if($payment->purchase_id){
            $purchase = Purchase::where('id',$payment->purchase_id)->first();
            $purchase->paid_amount =   $purchase->paid_amount- $payment->amount;
            $purchase->save();
        }else{
            $sale = Sale::where('id',$payment->sale_id)->first();
            $sale->paid_amount = $sale->paid_amount - $payment->amount;
            $sale->due_amount = $sale->due_amount + $payment->amount;
            if($sale->due_amount >=0){
                $sale->payment_status = 'Due';
            }else{
                $sale->payment_status = 'Paid';
            }
            $sale->save();
        }


        $payment->delete();
        $output = ['success' => true,
            'messege'            => "Payment Delete  success",
        ];
        return $output;
    }
}
