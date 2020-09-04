<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function  delete($id){
        $payment = Payment::find($id);
        $purchase = Purchase::where('id',$payment->purchase_id)->first();
        $purchase->paid_amount =   $purchase->paid_amount- $payment->amount;
        $purchase->save();
        $payment->delete();
        $output = ['success' => true,
            'messege'            => "Payment Delete  success",
        ];
        return $output;
    }
}
