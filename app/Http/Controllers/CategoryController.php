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

    public  function  create(Request $request){

        if($request->isMethod('post')){
                DB::beginTransaction();
                try {
                    if($request->id){
                        $category = Category::find($request->id);
                    }else{
                        $category = new Category();
                    }
                    $category->name = $request->name;
                    $category->parent_id = $request->parent_id;
                    $category->description = $request->description;
                    $category->featured = $request->featured? 1 : 0;
                    $category->slug = Str::slug( $request->name);

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

                    if($category->status==NULL){
                        $category->status  = 'Active';
                    }else{
                        $category->status  = $request->status;
                    }
                    $category->save();
                    DB::commit();
                    if($request->id){
                        Toastr::success('Success', 'Category  Update Success');
                    }else{
                        Toastr::success('Success', 'Category  Create Success');
                    }
                    return redirect()->route('category.index');
                }catch (\Exception $e){
                    DB::rollBack();
                    return $e->getMessage();
                }
        }
        $categories = Category::where('parent_id', 0)->get();
        $parent_categories ="";
        if (!empty($categories)) {
            $parent_categories = $categories;
        }

        return view($this->path.'create',compact('parent_categories'));
    }

    public  function  edit($id){
        $category = Category::find($id);
        return view($this->path.'create',compact('category'));
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
  $category->delete();
        Toastr::success('Success', 'Category  Delete Success');
        return redirect()->back();
    }
}
