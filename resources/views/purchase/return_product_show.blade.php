@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
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
                        <div class="d-flex align-items-center justify-content-between "
                             style="border-bottom: 1px solid #ddd">
                            <h3 class="purchase_title">Return Sale Details (Invoice No:
                                #{{$return_product->reference_no}})</h3>
                        </div>
                        <div class="purchase_details">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Invoice No: </strong> #{{$return_product->reference_no}}</p>
                                    <p>
                                        <strong>date: </strong> {{ date('d-m-Y', strtotime($return_product->created_at))}}
                                    </p>

                                </div>

                                <div class="col-md-4">
                                    <p>Biller: </p>
                                    <p><strong>{{$return_product->user?$return_product->supplier->name:''}}</strong></p>
                                    <p>018791302599</p>
                                    <p>aws@gmail.com</p>
                                    <p>Linking Street
                                        Phoenix,Arizona,USA</p>

                                </div>
                                <div class="col-md-4">
                                    <p>Customer Info:</p>
                                    <p>
                                        <strong>{{isset($return_product->supplier->name)?$return_product->supplier->name:''}}</strong>
                                    </p>
                                    <p>{{isset($return_product->supplier->email)?$return_product->supplier->email:''}}</p>
                                    <p>{{isset($return_product->supplier->phone)?$return_product->supplier->phone:''}}</p>
                                    <p>{{isset($return_product->supplier->address)?$return_product->supplier->address:''}}</p>
                                </div>
                            </div>
                        </div>
                        {{--                    <h4 class="mt-0 header-title"><a  href="#" class="btn btn-primary m-3">Add Purchase</a></h4>--}}

                        <table class="table table-bordered"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Product Name</th>
                                <th>Return Quantity</th>
                                <th>Unit Cost</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            $grandTotal = 0;
                            @endphp
                            @if(isset($return_product->productPurchaseReturns))
                                @foreach($return_product->productPurchaseReturns as $index=>$item)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>{{isset($item->product)?$item->product->name:''}}</td>
                                        <td>{{$item->qty}}Pc(s)</td>
                                        <td>{{number_format($item->unit_price,2)}}</td>
                                        <td>{{number_format($item->unit_price * $item->qty,2) }}</td>

                                    @php
                                        $total = $item->unit_price * $item->qty;
                                        $grandTotal = $grandTotal + $total;
                                        @endphp
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th colspan="3"></th>
                                <th >{{number_format($grandTotal,2)}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

<div class="col-12">
    <button id="print-btn" class="btn btn-primary">Print</button>
</div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('footerScripts')
    @parent
    <script>
        $("#print-btn").on("click", function () {
            var divToPrint = document.getElementById('purchase-details');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<link rel="stylesheet" href="<?php echo asset('/assets/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {#purchase-details { max-width: 1000px;} }</style><body onload="window.print()">' + divToPrint.innerHTML + '</body>');
            newWin.document.close();
            setTimeout(function () {
                newWin.close();
            }, 10);
        });

    </script>
@stop
