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
                        <div class="form-group row">
                            <label class=" col-md-3">Category Name</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Category  Name" name="cat_name">
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
