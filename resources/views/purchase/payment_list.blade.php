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

                    <h4 class="mt-0 header-title"><a  href="#" class="btn btn-primary m-3">Add Purchase</a></h4>

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
                                    <button  data-success_url="{{url('purchase/view/payment',$purchase->id)}}" data-token="{{ csrf_token() }}" data-url="{{ url('payment/delete', $payment->id) }}" class="btn btn-danger delete_payment"
                                                data-id="{{ $payment->id }}"  title="Delete">Delete</button>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

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
        $('#viewpayment_btn').on('click', function (e) {
            e.preventDefault();
            $('#viewpayment').modal('show');
        });



        $('#add_payment').on('click', function (e) {
            e.preventDefault();
            var id        = $(this).data("id");
            var amount      = $(this).data("due_amount");
            var grand_total      = $(this).data("grand_total");
            var paid_amount      = $(this).data("paid_amount");
            amount = grand_total - paid_amount
            console.log(amount);
            $('.modal_amount').val(amount);
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
                url:"{{url('purchase/add/payment')}}",
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
