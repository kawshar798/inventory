@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #cheque_number{
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
<div class="d-flex">
    <h4 class="mt-0 header-title">
        <button type="button"
                data-id="{{$sale->id}}"
                data-due_amount="{{$sale->due_amount}}"
                class="btn btn-primary m-3 edit-btn add_payment" data-toggle="modal" data-target="#addSupply">
            Add payment
        </button>
    </h4>
        <h3 class="header-title d-flex align-items-center">Sale Invoice No: #{{$sale->invoice_no}}</h3>
</div>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Date</td>
                            <td>Reference No</td>
                            <td>Amount</td>
                            <td>Payment Mode</td>
                            <td>Note</td>
                            <td>Delete</td>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($payments as $index=>$payment)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{date('d-m-Y',strtotime($payment->created_at))}}</td>
                                <td>{{$payment->payment_reference}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->paying_method}}</td>
                                <td>{{$payment->note}}</td>
                                <td>
                                    <button  data-success_url="{{url('purchase/view/payment',$sale->id)}}" data-token="{{ csrf_token() }}" data-url="{{ url('payment/delete', $payment->id) }}" class="btn btn-danger delete_payment"
                                                data-id="{{ $payment->id }}"  title="Delete">Delete</button>
                                    <button type="button"
                                            data-note="{{$payment->note}}"
                                            data-payment_reference="{{$payment->payment_reference}}"
                                            data-paying_method="{{$payment->paying_method}}"
                                            data-amount="{{$payment->amount}}"
                                            data-cheque_number="{{$payment->cheque_number}}"
                                            data-id="{{$sale->id}}"
                                            data-payment_id="{{$payment->id}}"
                                            class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#addFees1">
                                        Edit</i>
                                    </button>
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
                    <h5 class="modal-title mt-0" id="modalTitile">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="ajax-form-submit"   id="supplier_form"  method="POST">
                        <input type="hidden" class="success_url" value="{{url('sale/list')}}">
                        <input type="hidden" class="submit_url" value="{{url('sale/add/payment')}}">
                        <input type="hidden" class="method" value="POST">
                        @csrf
                        <input type="hidden" class="form-control modal_payment_id"  name="payment_id">
                        <input type="hidden" class="form-control modal_id"  name="id">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="">Amount</label>
                                <input type="text" class="form-control modal_amount "   placeholder="Enter Name" name="amount">

                            </div>
                            <div class="col-md-6">
                                <label>Payment Method</label>
                                <select name="paying_method" id="payment_method" class="form-control modal_payment_method">
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="cheque_number">
                                <div class="form-group">
                                    <label>Cheque Number</label>
                                    <input name="cheque_number"  class="form-control modal_cheque_number"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Payment Note</label>
                                    <textarea name="note" class="form-control modal_note"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light btn-save">
                                    Save Payment
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        /*  When user click add user button */
        $('.edit-btn').on('click', function (e) {
            e.preventDefault();
            var payment_id        = $(this).data("payment_id");
            var id        = $(this).data("id");
            var note    = $(this).data("note");
            var payment_reference  = $(this).data("payment_reference");
            var paying_method  = $(this).data("paying_method");
            var amount  = $(this).data("amount");
            var cheque_number  = $(this).data("cheque_number");
            $('.modal_amount').val(amount);
            $('.modal_payment_method').val(paying_method);
            $('.modal_note').val(note);
            $('.modal_cheque_number').val(cheque_number);
            $('.modal_payment_id').val(payment_id);
            $('.modal_id').val(id);
            $('.k').trigger("reset");
            $('#modalTitile').html("Edit Payment");
            $('.btn-save').html("Update Payment");
            $('#addSupply').modal('show');
        });
        /*  When user click add user button */
        $('.add_payment').click(function () {
            $('.btn-save').html("Add Brand");
            $('#k').trigger("reset");
            $('#modalTitile').html("Add New Brand");
            $('#addSupply').modal('show');
        });

        $('.add_payment').on('click', function (e) {
            e.preventDefault();
            var id        = $(this).data("id");
            var amount      = $(this).data("due_amount");
            var due_amount      = $(this).data("due_amount");
            // var paid_amount      = $(this).data("paid_amount");
            // amount = grand_total - paid_amount;
            console.log(amount);
            $('.modal_amount').val(due_amount);
            $('.modal_id').val(id);
            $('#addSupply').modal('show');
        });
        //payment method select
        $('#payment_method').on('change', function()
        {
            $payment = this.value;
            if($payment == 'Cheque'){
                $("#cheque_number").css("display", "block");
            }else{
                $("#cheque_number").hide();
            }
        });
        //Store payment
        $(document).on('submit', '.ajax-form-submit', function(e) {
            e.preventDefault();
            var submit_url = $(this).attr("submit_url");
            var success_url = $(this).attr("success_url");
            var fd = new FormData(document.getElementById("supplier_form"));
            $.ajax({
                method: 'POST',
                url:"{{url('sale/add/payment')}}",
                data:fd,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success == true) {
                        $('#addSupply').modal('hide');
                        toastr.success(result.messege);
                        location.reload(success_url);

                    } else {
                        toastr.error(result.messege);
                    }
                },
            });
        });
        // Purchase delete Delete
        $(document).on('click', '.delete_payment', function(e) {
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
