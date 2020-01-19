<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public  function __construct()
    {
        $this->path = 'product.';
    }

    public  function  index(){

        return view($this->path.'index');
    }

    public  function  create(){
        return view($this->path.'create');
    }


    public  function  store(Request $request){
        try{
            $unit = new Unit();
            $unit->name = $request->name;
            $unit->slug = Str::slug($request->name);
            $unit->status = $request->status;
            $unit->save();
            DB::commit();
            Toastr::success('message', 'Unit create  Success');
            return redirect()->route('unit.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

}
