@extends('layouts.app')
@section('title','Category')
@section('page_title','Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('category.index')}}">Category</a>
    </li>
    <li class="breadcrumb-item active">
        Category  Edit
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-md-2">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Category Edit</h4>

                    <form class="" action="{{route('category.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"  name="id" value="{{isset($category->id)?$category->id:''}}" >
                        <div class="form-group row">
                            <div class="col-md-4">   <label>Category Name</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Enter Category  Name" name="name" value="{{isset($category->name)?$category->name:''}}">
                            </div>
                        </div>
                        @if($parent_categories->isNotEmpty())
                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <input class="form-check-input" type="checkbox" id="add_as_sub_cat" name="add_as_sub_cat" value="1" class="toggler" data-toggle="collapse" data-target="#demo" @if($is_parent !=true) checked @endif/>Add as sub-category
                                </div>
                            </div>


                            <div class="form-group row collapse @if($is_parent !=true) show @endif"  id="demo">
                                <div class="col-md-4"><label>Parent Category</label></div>
                                <div class="col-md-8">
                                    <select id=parent class="form-control" name="parent_id" >
                                        <option value="">Select a Parent Category</option>
                                        @foreach($parent_categories as $p_category)
                                            <option value="{{$p_category->id}}" @isset($category->parent_id){{$category->parent_id==$p_category->id?'Selected':''}}@endisset > {{ $p_category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif


                        <div class="form-group row">
                            <div class="col-md-4"><label>Category Description</label></div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="description">{{isset($category->description)?$category->description:''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"><label> Category Image</label></div>
                            <div class="col-md-8">
                                <input class="form-control" type="file" id="image" name="image" value="{{isset($category->image)?$category->image:''}}"/>
                               @if(isset($category->image))
                               <img src="{{asset($category->image)}}" alt="{{$category->name}}"  style="height: 100px;width: 100px;">
                                   @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1 " @isset($category->featured){{$category->featured==1?'checked':''}}@endisset/>Featured Category

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"><label> Category Status</label></div>
                            <div class="col-md-8">
                                <select name="status" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="Active" @isset($category->status){{$category->status=='Active'?'Selected' : ''}} @endif >Active</option>
                                    <option value="Inactive" @isset($category->status){{$category->status=='Inactive'?'Selected' : ''}} @endif >Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
