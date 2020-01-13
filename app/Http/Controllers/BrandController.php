<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //
    public  function __construct()
    {
        $this->path = 'brand.';
    }

    public  function  index(){
        $brands = Brand::all();
        return view($this->path.'index',compact('brands'));
    }

    public  function  store(Request $request){
        try{
            $brand = new Brand();

            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name);
            if($request->hasfile('logo')){
                $logo = $request->logo;
                $extension = $logo->getClientOriginalExtension();
                $logo_name = Str::slug($request->name) . "-" . time() . "." . $extension;
                $path = 'public/images/brand_logo/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $logo->move($path, $logo_name);

                $brand->logo = $path . $logo_name;
            }
            $brand->status = $request->status;
            $brand->save();
            DB::commit();
                 Toastr::success('message', 'Brand create  Success');
            return redirect()->route('brand.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function  edit($id){
        $brand = Brand::find($id);
        return view($this->path.'index',compact('brand'));
    }

    public  function  update(Request $request){

        $brand = Brand::find($request->id);

        $brand->name  = $request->name;
        $brand->slug = Str::slug($request->name);
        if($request->hasfile('logo')){
            $logo = $request->logo;
            $extension = $logo->getClientOriginalExtension();
            $logo_name = Str::slug($request->name) . "-" . time() . "." . $extension;
            $path = 'public/images/brand_logo/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $logo->move($path, $logo_name);

            //delete old logo
            if ($brand->logo) {
                unlink($brand->logo);
            }
            $brand->logo = $path . $logo_name;
        }
        //update same database image
        if ($brand->logo) {
            $brand->logo = $brand->logo;
        }
        $brand->status = $request->status;
        $brand->save();
        DB::commit();
        Toastr::success('message', 'Brand Update  Success');
        return redirect()->route('brand.index');
    }

    public  function  active($id){
        $brand = Brand::find($id);
        $brand->status = 'Active';
        $brand->save();
        Toastr::success('Success', 'Brand  Active Success');
        return redirect()->back();
    }

    public  function  inactive($id){
        $brand = Brand::find($id);
        $brand->status = 'Inactive';
        $brand->save();
        Toastr::success('Success', 'Brand  InActive Success');
        return redirect()->back();
    }

    public  function  delete($id){
        $brand = Brand::findOrFail($id);
        if(!empty($brand->logo)){
            unlink($brand->logo);
        }
        $brand->delete();
        Toastr::success('Success', 'Brand  Delete Success');
        return redirect()->back();
    }


}
