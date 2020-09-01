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
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between " style="border-bottom: 1px solid #ddd">
                        <h3 class="purchase_title">Purchase Details (Reference No: #{{$purchase->reference_no}})</h3>
                        <a  href="#" class="btn btn-primary m-3">Add Purchase</a>
                    </div>
<div class="purchase_details">
    <div class="row">
        <div class="col-md-4">
            Reference No
            <h2>Reference No: #{{$purchase->reference_no}}</h2>
            <p>date: {{$purchase->date}}</p>
            <p>Purchase Status: {{$purchase->status}}</p>
        </div>

        <div class="col-md-4">
            <p>Supplier:</p>
            <h2>{{isset($purchase->supplier)?$purchase->supplier->name:''}}</h2>
            <p>{{isset($purchase->supplier)?$purchase->supplier->phone_number:''}}</p>
            <p>{{isset($purchase->supplier)?$purchase->supplier->email:''}}</p>
            <p>{{isset($purchase->supplier)?$purchase->supplier->Address:''}}</p>
        </div>
        <div class="col-md-4">
            <p>Business:</p>
            <h2>Awesome Shop Awesome Shop</h2>
            <p>018791302599}}</p>
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
                            <th>Purchase Quantity</th>
                            <th>Unit Cost </th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
{{--{{$purchase->purchaseProduct}}--}}
@php


    @endphp
                        <tbody>
                                                @foreach($purchase->purchaseProduct as $index=>$purchase)
                                                                                <tr>
                                                                                    <td>{{++$index}}</td>
                                                                                    <td>{{isset($purchase->product)?$purchase->product->name:''}}</td>
                                                                                    <td>{{$purchase->qty}}</td>
                                                                                    <td>{{isset($purchase->product)?$purchase->product->cost_price:''}}</td>
                                                                                    <td>{{$purchase->sub_total}}</td>
                                                                            @endforeach
{{--                        @foreach($purchases_products as $index=>$purchase)--}}
{{--                            <tr>--}}
{{--                                <td>{{++$index}}</td>--}}
{{--                                <td>{{$purchase->date}}</td>--}}
{{--                                <td>{{isset($purchase->supplier)?$purchase->supplier->name:''}}</td>--}}
{{--                                <td>{{$purchase->reference_no}}</td>--}}
{{--                                <td>{{$purchase->grand_total}}</td>--}}
{{--                                <td>{{$purchase->paid_amount}}</td>--}}
{{--                                <td>{{$purchase->grand_total - $purchase->paid_amount}}</td>--}}
{{--                                <td>@if($purchase->payment_status == 2)--}}
{{--                                        <span style="color: #fff; background: red;padding: 2px 5px;border-radius: 3px">Due</span>--}}
{{--                                    @else--}}
{{--                                        <span style="color: #fff; background: green;padding: 2px 5px;border-radius: 3px">Due</span>--}}
{{--                                    @endif</td>--}}
{{--                                <td>{{$purchase->status}}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{url('purchase/show',$purchase->id)}}">Show</a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
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
@stop
