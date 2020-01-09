<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //

    public  function  __construct()
    {
        $this->path = 'supplier.';

    }
    public  function  index(){
//        Toastr::info('message', 'title');
        return view($this->path.'index');
    }

    public  function  create(){
        return view($this->path.'create');
    }
}
