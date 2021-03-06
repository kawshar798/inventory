@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Employee')
@section('page_title','Employee')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('employee.create')}}">Employee Create</a>
    </li>
    <li class="breadcrumb-item active">
        Employee  List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <a href="{{route('employee.create')}}" class="btn btn-primary mb-3" >Employee  Create</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Experience</th>
                            <th>Photo</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($employees as $index=>$employee)

                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->phone}}</td>
                            <td>{{$employee->address}}</td>
                            <td>{{$employee->city}}</td>
                            <td>{{$employee->experience}}</td>
                            <td>{{$employee->photo}}</td>
                            <td>{{$employee->salary}}</td>
                            <td>
                                <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-warning"><i class="fas fa-arrow-circle-down"></i></a>
                                <a href="#" class="btn btn-success"><i class="fas fa-arrow-circle-up"></i></a>
                                <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{route('employee.delete',$employee->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
