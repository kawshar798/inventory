@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
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
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($purchases as $index=>$purchase)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$purchase->date}}</td>
                            <td>{{isset($purchase->supplier)?$purchase->supplier->name:''}}</td>
                            <td>{{$purchase->reference_no}}</td>
                            <td>{{$purchase->grand_total}}</td>
                            <td>{{$purchase->paid_amount}}</td>
                            <td>{{$purchase->grand_total - $purchase->paid_amount}}</td>
                            <td>@if($purchase->payment_status == 2)
                                    <span style="color: #fff; background: red;padding: 2px 5px;border-radius: 3px">Due</span>
                                @else
                                    <span style="color: #fff; background: green;padding: 2px 5px;border-radius: 3px">Due</span>
                                @endif</td>
                            <td>{{$purchase->status}}
                            </td>
                            <td>
                                <a href="{{url('purchase/show',$purchase->id)}}">Show</a>
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
@stop
