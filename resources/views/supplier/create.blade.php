@extends('layouts.app')
@section('title','Employee')
@section('page_title','Employee')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('employee')}}">Employee</a>
    </li>
    <li class="breadcrumb-item active">
        Employee  Create
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Employee Create</h4>

                    <form class="" action="#" novalidate="">
                        <div class="form-group row">
                            <label class=" col-md-3">Name</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Name" name="name">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Email</label>
                            <input type="email" class="form-control col-md-8"  placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">phone</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Phone" name="phone">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">City</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter city" name="city">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Address</label>
                            <textarea name="city" class="form-control col-md-8"></textarea>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Photo</label>
                            <input type="file" class="form-control col-md-8"  placeholder="Enter city" name="photo">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Salary</label>
                            <input type="number" class="form-control col-md-8"  placeholder="Enter Salary" name="salary">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Experience</label>
                       <select class="form-control col-md-8" name="experience">
                           <option>Select any one </option>
                           <option value="yes">Yes</option>
                           <option value="no">No</option>
                       </select>
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
