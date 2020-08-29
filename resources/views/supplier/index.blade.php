@extends('layouts.app')

@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .card-body.p_relative {
            position: relative;
        }

        .card-body.p_relative:after {
            position: absolute;
            background: #02c58d;
            height: 2px;
            width: 100%;
            content: "";
            left: 0;
            top: -10px;
            border-radius: 10px;
        }
    </style>
@endpush
@section('title','Supplier')
@section('page_title','Supplier')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('supplier.index')}}">Supplier</a>
    </li>
    <li class="breadcrumb-item active">
        Supplier  List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body p_relative">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Create Supplier</button>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Vat Number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($suppliers as $index=>$supplier)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$supplier->name}}</td>
                                <td>{{$supplier->phone_number}}</td>
                                <td>{{$supplier->email}}</td>
                                <td>
                                <img src="{{asset($supplier->image)}}" alt="supplier Image"  style="width: 100px;
    border-radius: 5px;"/>
                                </td>
                                <td>{{$supplier->vat_number}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>
                                    <a href="{{route('product.edit',$supplier->id)}}" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i></a>
                                    @if($supplier->status == 'Inactive')
                                        <button  data-success_url="{{url('supplier')}}" data-token="{{ csrf_token() }}" data-url="{{ url('supplier/active', $supplier->id) }}" class="btn btn-success active_supplier"
                                                 data-id="{{ $supplier->id }}"  title="Inactive"><i class="fas fa-thumbs-up"></i></button>
                                    @else
                                        <button  data-success_url="{{url('supplier')}}" data-token="{{ csrf_token() }}" data-url="{{ url('supplier/inactive', $supplier->id) }}" class="btn btn-warning inactive_supplier"
                                                 data-id="{{ $supplier->id }}"  title="Active"> <i class="fas fa-thumbs-down"></i></button>
                                    @endif
                                    <button  data-success_url="{{url('supplier')}}" data-token="{{ csrf_token() }}" data-url="{{ url('supplier/delete', $supplier->id) }}" class="btn btn-danger delete_supplier"
                                             data-id="{{ $supplier->id }}"  title="Delete"><i class="fas fa-trash"></i></button>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
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
                    <form class="ajax-form-submit"   id="supplier_form" enctype="multipart/form-data" method="POST">
                    <!-- <form action="{{url('admin/brand/store')}}" method="post" enctype="multipart/form-data" > -->
                        <input type="hidden" class="success_url" value="{{url('supplier')}}">
                        <input type="hidden" class="submit_url" value="{{url('admin/brand/store')}}">
                        <input type="hidden" class="method" value="POST">
                        <input type="hidden" class="id" name="id" value="">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="">Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Name" name="name">
                            </div>
                            <div class="col-md-6">
                                <label class="">Phone Number</label>
                                <input type="text" class="form-control"  placeholder="Enter Phone Number" name="phone_number">
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
                                <input type="text" class="form-control"  placeholder="Enter Business Name" name="business_name">
                            </div>
                            <div class="col-md-6">
                                <label class="">Vat Number</label>
                                <input type="text" class="form-control"  placeholder="Enter Vat Number" name="vat_number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Address</label>
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">City</label>
                                    <input type="text" class="form-control"  placeholder="Enter city" name="city">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">State</label>
                                    <input type="text" class="form-control"  placeholder="Enter state" name="state">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Postal code</label>
                                    <input type="text" class="form-control"  placeholder="Enter Postal Code" name="postal_code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Country </label>
                                    <input type="text" class="form-control"  placeholder="Enter Country" name="country">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Profile</label>
                                    <input type="file" class="form-control col-md-8"  placeholder="Enter city" name="image">
                                </div>
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection
@section('footerScripts')
    @parent
    <!-- Required datatable js -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>

    <script>
        //Store Supplier
        $(document).on('submit', '.ajax-form-submit', function(e) {
            e.preventDefault();
            var submit_url = $(this).attr("submit_url");
            var success_url = $(this).attr("success_url");
            var fd = new FormData(document.getElementById("supplier_form"));
            $.ajax({
                method: 'POST',
                url:"{{url('supplier/create')}}",
                data:fd,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success == true) {
                        $('#addFees').modal('hide');
                        toastr.success(result.messege);
                        location.reload(success_url);

                    } else {
                        toastr.error(result.messege);
                    }
                },
            });
        });

        // Supplier Active
        $(document).on('click', '.active_supplier', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title:"Are You Sure Active this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url:success_url,
                            type: 'PUT',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.messege);
                                    // setTimeout(function(){
                                    location.reload(success_url);
                                    // },  2000);
                                } else {
                                    toastr.error(result.messege);
                                }
                            },
                        });
                }
            });
        });

        // product Inactive
        $(document).on('click', '.inactive_supplier', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title:"Are You Sure Inactive this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url:success_url,
                            type: 'PUT',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.messege);
                                    // setTimeout(function(){
                                    location.reload(success_url);
                                    // },  2000);
                                } else {
                                    toastr.error(result.messege);
                                }
                            },
                        });
                }
            });
        });

        // product Delete
        $(document).on('click', '.delete_supplier', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title:"Are You Sure Delete this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url:success_url,
                            type: 'DELETE',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.messege);
                                    // setTimeout(function(){
                                    location.reload(success_url);
                                    // },  2000);
                                } else {
                                    toastr.error(result.messege);
                                }
                            },
                        });
                }
            });
        });

    </script>
@stop
