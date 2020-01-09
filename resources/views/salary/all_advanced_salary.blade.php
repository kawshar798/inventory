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
        <a href="{{route('employee.create')}}">Advanced  Salary</a>
    </li>
    <li class="breadcrumb-item active">
       All Advanced
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <a href="{{route('salary.advanced.add')}}" class="btn btn-primary mb-3" >Advanced salary   Add</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Advanced Salary</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($advanced_salaries as $index=>$advanced_salary)

                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$advanced_salary->name}}</td>
                                <td>
                                    <img src="{{url($advanced_salary->photo)}}" alt="{{$advanced_salary->name}}" style="width: 100px;height: 100px">
                                </td>
                                <td>{{$advanced_salary->month}}
                                </td>
                                <td>{{$advanced_salary->year}}</td>
                                <td>{{$advanced_salary->advanced_salary}}</td>
                                <td>
                                    {{--<a href="{{route('employee.edit',$employee->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-warning"><i class="fas fa-arrow-circle-down"></i></a>
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
