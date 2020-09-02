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
                            <th>S.L</th>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Reference</th>
                            <th>Grand Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Payment status</th>
                            <th>Purchase status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($purchases as $index=>$purchase)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$purchase->date}}</td>
                            <td>{{isset($purchase->supplier)?$purchase->supplier->name:''}}</td>
                            <td>
                                <a href="{{url('purchase/show',$purchase->id)}}">{{$purchase->reference_no}}</a>
                            </td>
                            <td>{{$purchase->grand_total}}</td>
                            <td>{{$purchase->paid_amount}}</td>
                            <td>{{$purchase->grand_total - $purchase->paid_amount}}</td>
                            <td>@if($purchase->payment_status == 2)
                                    <span style="color: #fff; background: red;padding: 2px 5px;border-radius: 3px">Due</span>
                                @else
                                    <span style="color: #fff; background: green;padding: 2px 5px;border-radius: 3px">Paid</span>
                                @endif</td>
                            <td>{{$purchase->status}}
                            </td>
                            <td>
                                <a href="{{url('purchase/show',$purchase->id)}}" class="btn btn-primary">Show</a>
                                <button type="button"
                                        data-id="{{$purchase->id}}"
                                        data-paid_amount="{{$purchase->paid_amount}}"
                                        data-grand_total="{{$purchase->grand_total}}"
                                        class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#addSupply" id="add_payment">
                                   Add payment
                                </button>
                                <button type="button"
                                        data-id="{{$purchase->id}}"
                                        data-paid_amount="{{$purchase->paid_amount}}"
                                        data-grand_total="{{$purchase->grand_total}}"
                                        class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#viewpayment" id="viewpayment_btn">
                                   View payment
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1"  id="viewpayment" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="modalTitile">View Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table payment-list">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Date</td>
                            <td>Reference No</td>
                            <td>Amount</td>
                            <td>Payment Mode</td>
                            <td>Note</td>
                        </tr>
                        </thead>

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


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
                    <form class="ajax-form-submit"   id="supplier_form"  method="POST">
                        <input type="hidden" class="success_url" value="{{url('purchase/list')}}">
                        <input type="hidden" class="submit_url" value="{{url('purchase/add/payment')}}">
                        <input type="hidden" class="method" value="POST">
                        @csrf
                        <input type="hidden" class="form-control modal_id "  name="id">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="">Amount</label>
                                <input type="text" class="form-control modal_amount "   placeholder="Enter Name" name="amount">

                            </div>
                            <div class="col-md-6">
                                <label>Payment Method</label>
                                <select name="paying_method" id="payment_method" class="form-control">
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="cheque_number">
                                <div class="form-group">
                                    <label>Cheque Number</label>
                                    <input name="cheque_number"  class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Payment Note</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
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
        //Store Supplier
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
    </script>
@stop
