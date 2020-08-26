<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
        $products = Product::all();

        $categories = Category::all();
        $brands = Brand::all();

        return view($this->path.'index',compact('products','categories','brands'));
    }


    public function  getProduct(Request $request){

//        $producdts = Product::where('category_id',?)->where('brand_id',$id)->get();
//        return $producdts->json();


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

            $product = new Product();
            $product->name = $request->name;
           $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->brand_id = $request->brand_id;
            $product->unit_id = $request->unit_id;
            $product->type = $request->type;
            $product->sku = $request->sku;
            $product->cost_price = $request->cost_price;
            $product->mrp = $request->mrp;
            $product->barcode = $request->barcode;
            $product->alert_quantity = $request->alert_quantity;
            $product->quantity = $request->quantity;
            $product->featured = $request->featured?1:0;
            $product->tax = $request->tax;
            $product->description = $request->description;

            if ($request->hasfile('image')) {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $image_name = Str::slug($request->name) . "-" . time() . "." . $extension;
                $path = 'public/images/product/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $image->move($path, $image_name);
                $product->image = $path . $image_name;
            }
            $product->status  = 'Active';
            $product->save();
            DB::commit();
            Toastr::success('message', 'Product  create  Success');
            return redirect()->route('product.index');
        }catch (\Exception $e){
            DB::rollBack();
            //            return back()->with('error', $e->getMessage());
            return $e->getMessage();
        }
    }

}
