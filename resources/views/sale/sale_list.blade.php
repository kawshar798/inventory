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

                    <h4 class="mt-0 header-title"><a  href="#" class="btn btn-primary m-3">Sale List</a></h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Date</th>
                            <th>Invoice No</th>
                            <th>Customer</th>
                            <th>Grand Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Total Quantity</th>
                            <th>Payment status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($sales as $index=>$sale)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{ date('d-m-Y', strtotime($sale->created_at))}}</td>
                            <td>{{$sale->invoice_no}}</td>
                            <td>{{$sale->customer?$sale->customer->name:''}}</td>
                            <td>{{$sale->grand_total}}</td>
                            <td>{{$sale->paid_amount}}</td>
                            <td>{{$sale->due_amount }}</td>
                            <td>{{$sale->total_qty }}</td>
                            <td>@if($sale->payment_status == 'Due')
                                    <span style="color: #fff; background: red;padding: 2px 5px;border-radius: 3px">Due</span>
                                @else
                                    <span style="color: #fff; background: green;padding: 2px 5px;border-radius: 3px">Paid</span>
                                @endif</td>

                            <td>
                                <a href="{{url('sale/show',$sale->id)}}" class="btn btn-primary">Show</a>
                                <a href="{{url('sale/view/payment',$sale->id)}}" class="btn btn-primary">Payment Show</a>
                                <a href="{{url('sale/invoice?invoice_no='.$sale->invoice_no)}}" class="btn btn-primary">Generate Invoice</a>
                                <button type="button"
                                        data-id="{{$sale->id}}"
{{--                                        data-paid_amount="{{$sale->paid_amount}}"--}}
                                        data-due_amount="{{$sale->due_amount}}"
                                        class="btn btn-primary m-3 edit-btn add_payment" data-toggle="modal" data-target="#addSupply">
                                   Add payment
                                </button>
                                <button  data-success_url="{{url('sale/list')}}" data-token="{{ csrf_token() }}" data-url="{{ url('sale/delete', $sale->id) }}" class="btn btn-danger delete_brand"
                                         data-id="{{ $sale->id }}"  title="Delete">Delete</button>
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