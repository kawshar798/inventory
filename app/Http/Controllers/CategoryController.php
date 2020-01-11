<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class CategoryController extends Controller
{
    //

    public  function __construct()
    {
        $this->path = 'category.';
    }

    public  function  index(){
        $categories = Category::all();
        return view($this->path.'index',compact('categories'));
    }

    public  function  create(Request $request){

        if($request->isMethod('post')){

                DB::beginTransaction();

                try {
                    $category = new Category();
                    $category->cat_name = $request->cat_name;
                    $category->slug = Str::slug( $category->cat_name);
                    $category->status  = 'Active';
                    $category->save();
                    DB::commit();

                    Toastr::success('Success', 'Category  Create Success');
                    return redirect()->route('category.index');
                }catch (\Exception $e){
                    DB::rollBack();
                    return $e->getMessage();
                }

        }

        return view($this->path.'create');
    }
}
