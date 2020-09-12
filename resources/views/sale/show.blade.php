@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        h3.purchase_title {
            font-size: 16px;
        }
        .purchase_details p {
            margin-bottom: 0px;
            padding-bottom: 5px;
        }

        .purchase_details {
            padding-top: 20px;
            padding-bottom: 35px;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div id="purchase-details">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between " style="border-bottom: 1px solid #ddd">
                        <h3 class="purchase_title">Sale Details (Invoice No: #{{$sale->invoice_no}})</h3>
                        <a  href="#" class="btn btn-primary m-3">Sale List</a>
                    </div>
<div class="purchase_details">
    <div class="row">
        <div class="col-md-4">
            <p><strong>Invoice No: </strong> #{{$sale->invoice_no}}</p>
            <p><strong>date: </strong> {{ date('d-m-Y', strtotime($sale->created_at))}}</p>
            <p><strong>Sale Status:</strong> {{$sale->payment_status}}</p>
        </div>

        <div class="col-md-4">
            <p>Biller: </p>
            <p><strong>{{$sale->user?$sale->user->name:''}}</strong></p>

        </div>
        <div class="col-md-4">
            <p>Business:</p>
            <p><strong>Awesome Shop</strong></p>
            <p>018791302599</p>
            <p>aws@gmail.com</p>
            <p>Linking Street
                Phoenix,Arizona,USA</p>
        </div>
    </div>
</div>
{{--                    <h4 class="mt-0 header-title"><a  href="#" class="btn btn-primary m-3">Add Purchase</a></h4>--}}

                    <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Product Name</th>
                            <th>Sale Quantity</th>
                            <th>Unit Cost </th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($sale->productSales))
                            @foreach($sale->productSales as $index=>$item)
                                                                                <tr>
                                                                                    <td>{{++$index}}</td>
                                                                                    <td>{{isset($item->product)?$item->product->name:''}}</td>
                                                                                    <td>{{$item->qty}}Pc(s)</td>
                                                                                    <td>{{number_format($item->unit_price,2)}}</td>
                                                                                    <td>{{number_format($item->total,2)}}</td>
                                                                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="payment-table">
                            <h3>Payment list</h3>
                            <table class="table">
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
                                <tbody>

                                @php
                                    $payments =   DB::table('payments')->where('sale_id',$sale->id)->get();
                                @endphp
                                @foreach($payments as $index=>$payment)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>{{date('d-m-Y',strtotime($payment->created_at))}}</td>
                                        <td>{{$payment->payment_reference}}</td>
                                        <td>{{$payment->amount}}</td>
                                        <td>{{$payment->paying_method}}</td>
                                        <td>{{$payment->note}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="purchase-summary">
                            <table class="table">
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td>{{number_format($sale->total_price,2)}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Tax</strong></td>
                                    <td>{{number_format($sale->order_tax,2)}}</td>

                                </tr>
                                <tr>
                                    <td><strong>Discount</strong></td>
                                    <td>{{number_format($sale->order_discount,2)}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Shipping Cost</strong></td>
                                    <td>{{number_format($sale->shipping_cost,2)}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total</strong></td>
                                    <td>{{number_format($sale->grand_total,2)}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Paid Amount</strong></td>
                                    <td>{{ number_format($sale->paid_amount,2)}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Due</strong> </td>
                                    <td>{{ number_format($sale->due_amount,2)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary" id="print-btn">Print</button>
                    </div>
                </div>
            </div>


        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('footerScripts')
    @parent
    <script>
        $("#print-btn").on("click", function(){
            var divToPrint=document.getElementById('purchase-details');
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<link rel="stylesheet" href="<?php echo asset('/assets/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {#purchase-details { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
        });

    </script>
@stop
