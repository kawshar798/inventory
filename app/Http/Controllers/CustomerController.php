<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public  function  __construct()
    {
        $this->path = 'customer.';

    }
    public  function  index(){
//        Toastr::info('message', 'title');
        return view($this->path.'index');
    }

    public  function  create(){
        return view($this->path.'create');
    }
}
