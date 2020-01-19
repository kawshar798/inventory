<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\TaxRate;
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

        $categories = Category::where('status','Active')->get();
        $brands = Brand::where('status','Active')->get();
        $units = Unit::where('status','Active')->get();
        $taxes = TaxRate::where('status','Active')->get();
        return view($this->path.'create',compact('categories','brands','units','taxes'));
    }
        public  function  showSubcat($id){
            $subCategories = Category::where('parent_id',$id)->where('status','Active')->get();
            return json_encode($subCategories);
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
