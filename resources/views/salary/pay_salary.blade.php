@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Salary')
@section('page_title','Salary')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('employee.create')}}">Pay Salary </a>
    </li>
    <li class="breadcrumb-item active">
        Pay Salary
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2"><a href="{{route('salary.advanced.add')}}" class="btn btn-primary" >Advanced  salary pay</a>
                    <h2 style="margin: 0px;"><span class="d-flex badge badge-success align-items-center">{{date("F Y")}}</span></h2></div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Salary</th>
                            <th>Month</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($employees as $index=>$employee)

                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$employee->name}}</td>
                                <td>
                                    <img src="{{url($employee->photo)}}" alt="{{$employee->name}}" style="width: 80px;height: 80px">
                                </td>
                                <td>{{$employee->salary}}
                                </td>
                                <td><h4><span class="badge badge-success">{{date("F",strtotime('-1 months'))}}</span></h4></td>

                                <td>
                                   <a href="#" class="btn btn-info">Pay Now</a>
                                    {{--<a href="#" class="btn btn-warning"><i class="fas fa-arrow-circle-down"></i></a>
                                   <a href="#" class="btn btn-success"><i class="fas fa-arrow-circle-up"></i></a>
                                   <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                   <a href="{{route('employee.delete',$employee->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
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
