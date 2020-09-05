<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //

    public  function  __construct()
    {
        $this->path = 'customer.';

    }
    public  function  index(){
            $customers = Customer::all();
        return view($this->path.'index',compact('customers'));
    }

    public  function  create(Request $request){
        DB::beginTransaction();
        try{
            if($request->id){
                $customer = Customer::find($request->id);
            }else{
                $customer = new Customer();
            }
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "Customer  Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Customer  Create success",
                ];
            }
            return  $output;
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

    }
}
