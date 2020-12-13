<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
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

    public  function  create(){
        $parent_categories = Category::where('parent_id', 0)->get();
        return view($this->path.'create',compact('parent_categories'));
    }


    public  function  store(Request $request){
        DB::beginTransaction();
        try {
            $category = new Category();
            if (!empty($request->input('add_as_sub_cat')) &&  $request->input('add_as_sub_cat') == 1 && !empty                     ($request->parent_id)) {
                $category->parent_id = $request->parent_id;
            } else {
                $category->parent_id = 0;
            }
            $category->name         = $request->name;
            $category->slug         = Str::slug( $request->name);
            $category->description  = $request->description;
            $category->featured     = $request->featured? 1 : 0;

            if ($request->hasfile('image')) {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $image_name = Str::slug($request->name) . "-" . time() . "." . $extension;
                $path = 'public/images/category/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $image->move($path, $image_name);
                $category->image = $path . $image_name;
            }
            $category->status  = $request->status;
            $category->save();
            DB::commit();
            Toastr::success('Success', 'Category  Create Success');
            return redirect()->route('category.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public  function  edit($id){
        $parent_categories = Category::where('parent_id', 0)->get();
        $category = Category::findOrFail($id);

        if($category->parent_id==0){
            $is_parent = true;
        }else{
            $is_parent = false;
        }
        return view($this->path.'edit',compact('category','parent_categories','is_parent'));
    }


    public function  update(Request $request){
        $category = Category::find($request->id);
        try {
            if (!empty($request->input('add_as_sub_cat')) &&  $request->input('add_as_sub_cat') == 1 && !empty                      ($request->parent_id)) {
                $category->parent_id = $request->parent_id;
            } else {
                $category->parent_id = 0;
            }
            $category->name         = $request->name;
            $category->slug         = Str::slug( $request->name);
            $category->description  = $request->description;
            $category->featured     = $request->featured? 1 : 0;

            if ($request->hasfile('image')) {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $image_name = Str::slug($request->name) . "-" . time() . "." . $extension;
                $path = 'public/images/category/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $image->move($path, $image_name);
                //delete old image
                if ($category->image) {
                    unlink($category->image);
                }
                $category->image = $path . $image_name;
            }
            //update same database image
            if ($category->image) {
                $category->image = $category->image;
            }
            $category->status  = $request->status;
            $category->save();
            DB::commit();
            Toastr::success('Success', 'Category  Update Success');
            return redirect()->route('category.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public  function  active($id){
        $category = Category::find($id);
        $category->status = 'Active';
        $category->save();
        Toastr::success('Success', 'Category  Active Success');
        return redirect()->back();
    }

    public  function  inactive($id){
        $category = Category::find($id);
        $category->status = 'Inactive';
        $category->save();
        Toastr::success('Success', 'Category  InActive Success');
        return redirect()->back();
    }

    public  function  delete($id){
        $category = Category::findOrFail($id);
        unlink($category->image);
        $category->delete();
        Toastr::success('Success', 'Category  Delete Success');
        return redirect()->back();
    }
}
