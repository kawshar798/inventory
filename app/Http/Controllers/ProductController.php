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
use Milon\Barcode\DNS1D;

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

//for pos
    public function  getProduct(Request $request){
        $category_id  = $request->categoryId;
        $brand_id     = $request->brandId;
        $products = Product::all();
            if($category_id != 'all'){
                $products = Product::where(function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                    $query->orWhere('sub_category_id', $category_id);
                })->get();
            }
        if($brand_id != 'all'){
            $products = Product::where('brand_id', $brand_id)->get();
        }
        return  $products;
    }

    //For product purchase
    public function  getSingleProduct($id){

        $product = Product::where('id',$id)->first();
        return  $product;
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

            if($request->id){
                $product = Product::find($request->id);
            }else{
                $product = new Product();
            }
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
            if($request->id){
                Toastr::success('message', 'Product  Update  Success');
            }else{
                Toastr::success('message', 'Product  create  Success');
            }
            return redirect()->route('product.index');
        }catch (\Exception $e){
            DB::rollBack();
            //            return back()->with('error', $e->getMessage());
            return $e->getMessage();
        }
    }

    public  function  edit($id){
        $product = Product::find($id);
        $categories = Category::where('status','Active')->get();
        $brands = Brand::where('status','Active')->get();
        $units = Unit::where('status','Active')->get();
        $taxes = TaxRate::where('status','Active')->get();
        $sub_categories = Category::where( 'parent_id', '!=',0 )->where( 'status', 'Active' )->get();
        return view($this->path.'create',compact('categories','brands','units','taxes','product','sub_categories'));
    }
    public function active($id){
        $category = Product::find( $id );
        $category->status = 'Active';
        $category->save();
        $output = ['success' => true,
            'messege'            => "Product Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $category = Product::find( $id );
        $category->status = 'Inactive';
        $category->save();
        $output = ['success' => true,
            'messege'            => "Product InActive success",
        ];
        return $output;
    }



    public function printBarcode(Request $request)
    {
        if($request->product_name){
            $q = $request->product_name;
            $product = Product::where('name','LIKE','%'.$q.'%')->first();
            return $product;
        }



//            if(count($user) > 0)
//                return view('welcome')->withDetails($user)->withQuery ( $q );
//            else return view ('welcome')->withMessage('No Details found. Try to search again !');



        return view($this->path.'print_barcode');
    }
    public function printgetBarcode(Request $request)
    {

        $lims_product_data = Product::where('barcode',$request->barcode)->first();
        return $lims_product_data;
        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->price;

        $product[] = DNS1D::getBarcodePNG($lims_product_data->barcode, $lims_product_data->barcode_symbology);
            return $product;

    }

    public function delete( $id ) {
        $product = Product::find( $id );
        if (file_exists($product->image)) {
            unlink( $product->image );
        }

        $product->delete();
        $output = ['success' => true,
            'messege'            => "Product Delete success",
        ];
        return $output;
    }



}
