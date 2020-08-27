<?php

namespace App\Http\Controllers;

use App\Models\TaxRate;
use App\Models\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaxRateController extends Controller
{
    //
    public  function __construct()
    {
        $this->path = 'tax.';
    }

    public  function  index(){
        $taxes = TaxRate::all();
        return view($this->path.'index',compact('taxes'));
    }

    public  function  store(Request $request){
        try{
            $tax = new TaxRate();
            $tax->name = $request->name;
            $tax->code = $request->code;
            $tax->amount = $request->amount;
//            $tax->type = $request->type;
            $tax->status = $request->status;
            $tax->save();
            DB::commit();
            Toastr::success('Success!!!', 'Tax create  Success');
            return redirect()->route('setting.tax.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function  edit($id){
        $tax = TaxRate::find($id);
        return view($this->path.'index',compact('tax'));
    }

    public  function  update(Request $request){


        $tax = TaxRate::find($request->id);
        $tax->name = $request->name;
        $tax->code = $request->code;
        $tax->amount = $request->amount;
//        $tax->type = $request->type;
        $tax->status = $request->status;
        $tax->save();
        DB::commit();
        Toastr::success('Success', 'Tax Update  Success');
        return redirect()->route('setting.tax.index');
    }

    public  function  active($id){
        $tax = TaxRate::find($id);
        $tax->status = 'Active';
        $tax->save();
        Toastr::success('Success', 'Unit  Active Success');
        return redirect()->back();
    }

    public  function  inactive($id){
        $tax = TaxRate::find($id);
        $tax->status = 'Inactive';
        $tax->save();
        Toastr::success('Success', 'Unit  InActive Success');
        return redirect()->back();
    }

    public  function  delete($id){
        $tax = TaxRate::findOrFail($id);
        $tax->delete();
        Toastr::success('Success', 'Unit  Delete Success');
        return redirect()->back();
    }
}
