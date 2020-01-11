@extends('layouts.app')
@section('title','Category')
@section('page_title','Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('category.index')}}">Category</a>
    </li>
    <li class="breadcrumb-item active">
        Category  Create
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Category Create</h4>

                    <form class="" action="{{route('category.create')}}" method="POST">
                        @csrf
                        <input value="{{isset($category->id)?$category->id:''}}" name="id" type="hidden">
                        <div class="form-group row">
                            <label class=" col-md-3">Category Name</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Category  Name" name="cat_name" value="{{isset($category->cat_name)?$category->cat_name:''}}">
                        </div>

                        <div class="form-group">
                            <label for="parent">Parent Category <span class="m-l-5 text-danger"> *</span></label>
                            <select id=parent class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="0">Select a parent category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured"/>Featured Category
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div></div>
                        @if(isset($category->id))
                            <label class=" col-md-3">Category Status</label>
                            <select name="status" class="form-control">
                                <option value="">Select One</option>
                                <option value="Active" @isset($category->status){{$category->status=='Active'?'Selected' : ''}} @endif >Active</option>
                                <option value="Inactive" @isset($category->status){{$category->status=='Inactive'?'Selected' : ''}} @endif >Inactive</option>
                            </select>
                            @endif
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
