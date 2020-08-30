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
                    <button type="button" id="create-new-supplier" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Create Supplier</button>

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
                            <th>
                             Status
                            </th>
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
                                <img src="{{asset($supplier->image)}}" alt="supplier Image"  style="width: 60px;
    border-radius: 5px;"/>
                                </td>
                                <td>{{$supplier->vat_number}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>
                                @if($supplier->status == 'Inactive')
                                    <span class="badge badge-warning">Inactive</span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                                </td>
                                <td>
                                    <button type="button"
                                            data-name="{{$supplier->name}}"
                                            data-logo="{{$supplier->image}}"
                                            data-phone_number="{{$supplier->phone_number}}"
                                            data-business_name="{{$supplier->business_name}}"
                                            data-email="{{$supplier->email}}"
                                            data-id="{{$supplier->id}}"
                                            data-vat_number="{{$supplier->vat_number}}"
                                            data-address="{{$supplier->address}}"
                                            data-state="{{$supplier->state}}"
                                            data-status="{{$supplier->status}}"
                                            data-city="{{$supplier->city}}"
                                            data-postal_code="{{$supplier->postal_code}}"
                                            data-country="{{$supplier->country}}"
                                            class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#addSupply2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    @if($supplier->status == 'Inactive')
                                        <button  data-success_url="{{url('supplier')}}" data-token="{{ csrf_token() }}" data-url="{{ url('supplier/active', $supplier->id) }}" class="btn btn-success active_supplier"
                                                 data-id="{{ $supplier->id }}"  title="Active"><i class="fas fa-thumbs-down"></i></button>
                                    @else
                                        <button  data-success_url="{{url('supplier')}}" data-token="{{ csrf_token() }}" data-url="{{ url('supplier/inactive', $supplier->id) }}" class="btn btn-warning inactive_supplier"
                                                 data-id="{{ $supplier->id }}"  title="Inactive"> <i class="fas fa-thumbs-up"></i></button>
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1"  id="addSupply" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="modalTitile">Large modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="ajax-form-submit"   id="supplier_form" enctype="multipart/form-data" method="POST">
                        <input type="hidden" class="success_url" value="{{url('supplier')}}">
                        <input type="hidden" class="submit_url" value="{{url('admin/brand/store')}}">
                        <input type="hidden" class="method" value="POST">
                        <input type="text" class="id" name="id" value="">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="">Name</label>
                                <input type="text" class="form-control modal_name "   placeholder="Enter Name" name="name">
                            </div>
                            <div class="col-md-6">
                                <label class="">Phone Number</label>
                                <input type="text" class="form-control modal_phone_number"  placeholder="Enter Phone Number" name="phone_number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Email</label>
                                <input type="email" class="form-control modal_email"  placeholder="Enter email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="">Business Name</label>
                                <input type="text" class="form-control modal_business_name"  placeholder="Enter Business Name" name="business_name">
                            </div>
                            <div class="col-md-6">
                                <label class="">Vat Number</label>
                                <input type="text" class="form-control modal_vat_number"  placeholder="Enter Vat Number" name="vat_number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Address</label>
                                    <textarea name="address" class="form-control modal_address"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">City</label>
                                    <input type="text" class="form-control modal_city"  placeholder="Enter city" name="city">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">State</label>
                                    <input type="text" class="form-control modal_state"  placeholder="Enter state" name="state">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Postal code</label>
                                    <input type="text" class="form-control modal_postal_code"  placeholder="Enter Postal Code" name="postal_code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Country </label>
                                    <input type="text" class="form-control modal_country"  placeholder="Enter Country" name="country">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Profile</label>
                                    <input type="file" class="form-control col-md-8 modal_logo"  placeholder="Enter city" name="image">
                                    <div id="modal-input-image"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-save">
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

        $(document).ready(function () {
        /*  When user click add user button */
        $('#create-new-supplier').click(function () {
            $('#btn-save').html("Add Supplier");
            $('#supplier_form').trigger("reset");
            $('#modalTitile').html("Add New Supplier");
            $('#addSupply').modal('show');
        });

        /*  When user click add user button */
        $('.edit-btn').on('click', function (e) {
            e.preventDefault();

            var id        = $(this).data("id");
            var name      = $(this).data("name");
            var phone_number       = $(this).data("phone_number");
            var email       = $(this).data("email");
            var vat_number       = $(this).data("vat_number");
            var business_name       = $(this).data("business_name");
            var address       = $(this).data("address");
            var status       = $(this).data("status");
            var country       = $(this).data("country");
            var state       = $(this).data("state");
            var city       = $(this).data("city");
            var logo       = $(this).data("logo");
            var postal_code       = $(this).data("postal_code");
            $('.modal_name').val(name);
            $('.modal_phone_number').val(phone_number);
            $('.modal_email').val(email);
            $('.modal_business_name').val(business_name);
            $('.modal_vat_number').val(vat_number);
            $('.modal_address').val(address);
            $('.modal_city').val(city);
            $('.modal_state').val(state);
            $('.modal_postal_code').val(postal_code);
            $('.modal_country').val(country);


            $('.id').val(id);
            var category_image = "<img src='"+ '{{asset('/')}}/'+logo+"' height='100' width='100'>";

            if(logo){
                $("#modal-input-image").html(category_image);
            }

            // $('#supplier_form').trigger("reset");
            $('#modalTitile').html("Edit Supplier");
            $('#btn-save').html("Update Supplier");
            $('#addSupply').modal('show');
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

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
        });

    </script>
@stop
