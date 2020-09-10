@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />

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
                            <th>Code</th>
                            <th>Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($coupons as $index=>$coupon)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>{{$coupon->amount}}</td>
                                <td>{{$coupon->start_date}}</td>
                                <td>{{$coupon->end_date}}</td>
                                <td>
                                @if($coupon->status == 'Active')
                                    <span class="badge badge-success">{{$coupon->status}}</span>
                                    @else
                                        <span class="badge badge-danger">{{$coupon->status}}</span>
                                    @endif

                                </td>
                                <td>
                                    <button type="button"
                                            data-code="{{$coupon->code}}"
                                            data-amount="{{$coupon->amount}}"
                                            data-start_date="{{$coupon->start_date}}"
                                            data-end_date="{{$coupon->end_date}}"
                                            data-status="{{$coupon->status}}"
                                            data-id="{{$coupon->id}}"
                                            class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#showModal">
                                        Edit</i>
                                    </button>
                                    <button
                                        data-success_url="{{url('expense')}}"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{ url('coupon/delete', $coupon->id) }}"
                                        data-id="{{ $coupon->id }}"
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
                            <label for="example-email-input" class="col-sm-3 col-form-label">Coupon Code</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_code"  type="text" placeholder="Enter Coupon Coe" name="code">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label"> Amount</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_amount"  type="number" placeholder="Enter Amount" name="amount">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label"> Start Date</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_start_date" id="start_date"  type="text" placeholder="Enter Start Date" name="start_date">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label"> End Date</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_end_date" id="end_date"   type="text" placeholder="Enter Start Date" name="end_date">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label"> Status</label>
                            <div class="col-sm-9">
                              <select name="status" class="form-control">
                                  <option>Select One</option>
                                  <option value="Active">Active</option>
                                  <option value="Inactive">Inactive</option>
                              </select>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script>

        //Date pikcer
        $(function () {
            $('#start_date').datetimepicker({

                format: 'YYYY-MM-DD',
            });
        });
        $(function () {
            $('#end_date').datetimepicker({

                format: 'YYYY-MM-DD',
            });
        });
        $('#create-new-expense').on('click',function (e) {
            e.preventDefault();
            $("#modalTitile").html("Create New Coupon ");
            $(".btn-save").html("Add Coupon");
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
                url:"{{url('coupon/create')}}",
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
            var code    = $(this).data("code");
            var amount      = $(this).data("amount");
            var start_date      = $(this).data("start_date");
            var end_date      = $(this).data("end_date");
            var status      = $(this).data("status");
            $('.modal_code').val(code);
            $('.modal_amount').val(amount);
            $('.modal_start_date').val(start_date);
            $('.modal_end_date').val(end_date);
            $('.modal_status').val(status);
            $('.id').val(id);
            $('.k').trigger("reset");
            $('#modalTitile').html("Edit Coupon");
            $('.btn-save').html("Update Coupon ");
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
                            type: 'GET',
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
