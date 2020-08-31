<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\TaxRate;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //

    public  function  __construct()
    {
        $this->path = 'purchase.';

    }
    public function  create(){
        $suppliers = Supplier::where('status','Active')->get();
        $products = Product::where('status','Active')->get();
        $taxes = TaxRate::where('status','Active')->get();
        return view($this->path.'create',compact('suppliers','products','taxes'));

    }
}
