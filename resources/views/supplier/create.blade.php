@extends('layouts.app')
@section('title','Supplier')
@section('page_title','Supplier')
@push('head_styles')
    <style>
        .card-body.p_relative {
            position: relative;
        }

        .card-body.p_relative:after {
            position: absolute;
            background: red;
            height: 2px;
            width: 100%;
            content: "";
            left: 0;
            top: -10px;
            border-radius: 10px;
        }
    </style>
    @endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('employee.index')}}">Employee</a>
    </li>
    <li class="breadcrumb-item active">
        Employee  Create
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card m-b-30">
                <div class="card-body p_relative">

                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>
                    <h4 class="mt-0 header-title"> Create</h4>
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Large modal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Cras mattis consectetur purus sit amet fermentum.
                                        Cras justo odio, dapibus ac facilisis in,
                                        egestas eget quam. Morbi leo risus, porta ac
                                        consectetur ac, vestibulum at eros.</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Vivamus sagittis lacus vel
                                        augue laoreet rutrum faucibus dolor auctor.</p>
                                    <p>Aenean lacinia bibendum nulla sed consectetur.
                                        Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Donec sed odio dui. Donec
                                        ullamcorper nulla non metus auctor
                                        fringilla.</p>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <form class="" action="#" novalidate="">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="">Name</label>
                                <input type="text" class="form-control col-md-8"  placeholder="Enter Name" name="name">
                            </div>
                            <div class="col-md-6">
                                <label class="">Phone Number</label>
                                <input type="text" class="form-control col-md-8"  placeholder="Enter Phone Number" name="phone_number">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Email</label>
                                <input type="email" class="form-control"  placeholder="Enter email" name="email">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="">Business Name</label>
                                <input type="text" class="form-control col-md-8"  placeholder="Enter Business Name" name="business_name">
                            </div>
                            <div class="col-md-6">
                                <label class="">Vat Number</label>
                                <input type="text" class="form-control col-md-8"  placeholder="Enter Vat Number" name="vat_number">
                            </div>

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
