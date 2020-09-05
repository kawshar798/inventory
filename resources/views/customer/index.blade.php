@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Customer')
@section('page_title','Customer')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('customer.index')}}">Customer</a>
    </li>
    <li class="breadcrumb-item active">
        Customer  List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#showModal" id="create-new-expense">
                        Customer Create
                    </button>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($customers as $index=>$customer)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->address}}</td>
                            <td>
                                <button type="button"
                                        data-name="{{$customer->name}}"
                                        data-email="{{$customer->email}}"
                                        data-phone="{{$customer->phone}}"
                                        data-address="{{$customer->address}}"
                                        data-id="{{$customer->id}}"
                                        class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#showModal">
                                    Edit</i>
                                </button>
                                <button
                                    data-success_url="{{url('expense')}}"
                                    data-token="{{ csrf_token() }}"
                                    data-url="{{ url('$customer/delete', $customer->id) }}"
                                    data-id="{{ $customer->id }}"
                                    class="btn btn-danger delete_brand"
                                    title="Delete">Delete</button>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal" id="showModal">
        <div class="modal-dialog">
            <div class="modal-content">
                </tbody>
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitile"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="ajax-form-submit"   id="k" enctype="multipart/form-data" method="POST">
                    <input type="hidden" class="success_url" value="{{url('customer')}}">
                    <input type="hidden" class="submit_url" value="{{url('customer/create')}}">
                    <input type="hidden" class="method" value="POST">
                    <input type="hidden" class="id" name="id" value="">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label"> Name</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_name"  type="text" placeholder="Expense  Amount" name="name">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label"> Email</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_email"  type="email" placeholder="Expense  Email" name="email">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label"> Phone</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_phone"  type="text" placeholder="Enter Customer Phone" name="phone">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea name="address" class="form-control address_modal"></textarea>
                                <span id="msg"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger close_btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-save"></button>
                    </div>
                </form>
            </div>
        </div>
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
    $('#create-new-expense').on('click',function (e) {
        e.preventDefault();
        $("#modalTitile").html("Create New Customer ");
        $(".btn-save").html("New Customer");
        $("#showModal").show();
    });
    //Store Customer
    $(document).on('submit', '.ajax-form-submit', function(e) {
        e.preventDefault();
        var submit_url = $(this).attr("submit_url");
        var success_url = $(this).attr("success_url");
        var fd = new FormData(document.getElementById("k"));
        $.ajax({
            method: 'POST',
            url:"{{url('customer/create')}}",
            data:fd,
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
    /*  When user click Edit user button */
    $('.edit-btn').on('click', function (e) {
        e.preventDefault();
        console.log('kk');
        var id        = $(this).data("id");
        var name    = $(this).data("name");
        var email      = $(this).data("email");
        var phone      = $(this).data("phone");
        var address      = $(this).data("address");
        $('.modal_name').val(name);
        $('.modal_email').val(email);
        $('.modal_phone').val(phone);
        $('.address_modal').val(address);
        $('.id').val(id);
        $('.k').trigger("reset");
        $('#modalTitile').html("Edit Customer");
        $('.btn-save').html("Update Customer ");
        $("#showModal").show();
    });

    $(document).on('click', '.delete_brand', function(e) {
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
