<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
use App\Models\TaxRate;
use Illuminate\Http\Request;

class PosController extends Controller
{
    //

    public  function  createPos(Request $request){

        $categories = Category::all();
        $brands = Brand::all();
        $taxs = TaxRate::where('status','Active')->get();
//        return view('sale.pos_create',compact('products','categories','brands'));
        $products = Product::where('status','Active')->get();
        $customers = Customer::get();
        return view('sale.pos_create')->with(compact('categories','brands','taxs','products','customers'));
    }
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
        return $products;
    }

    public function  singleProduct($id){

        $products = Product::where('id',$id)->first();
        return $products;
    }
    public function  allCustomerList(){
        $customers = Customer::get();
        return $customers;
    }

    public  function  checkCouponCode($id){

        $coupon = Coupon::where('code',$id)->where('status','Active')->first();
        if($coupon){
          return  $coupon->amount;
        }else{
            $output = ['error' => true,
                'messege'            => "invalid",
            ];
            return $output;
        }

    }


}
