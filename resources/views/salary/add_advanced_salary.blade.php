@extends('layouts.app')
@section('title','Employee')
@section('page_title','Employee')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="">Salary</a>
    </li>
    <li class="breadcrumb-item active">


        @if(isset($employee->id))
            Employee  Update
        @else
            Employee  Create
        @endif
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card m-b-30">
                <div class="card-body">
                    @if(isset($employee->id))
                        <h4 class="mt-0 header-title">Employee Update</h4>
                    @else
                        <h4 class="mt-0 header-title">Employee Create</h4>
                    @endif


                    <form class="" action="{{route('salary.advanced.add')}}" novalidate="" method="POST">
                        @csrf
{{--                        <input value="{{isset($employee->id)?$employee->id:''}}" name="id" type="hidden">--}}
                        <div class="form-group row">
                            <label class=" col-md-3">Employee Name</label>
                            <select name="employee_id" class="form-control col-md-8">
                                <option value="">Select One</option>
                                @foreach($employees as $index=>$employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach

                            </select>
                        </div>

                        <div class="form-group row">
                            <label class=" col-md-3">Advanced Salary</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Salary" name="advanced_salary" value="{{isset($employee->vacation)?$employee->vacation:''}}">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Month  Name</label>
                            <select name="month" class="form-control col-md-8">
                                <option value="">Select One</option>
                                <option value="January">January</option>
                                <option value="Febuary">Febuary</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Year</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Year" name="year" value="{{isset($employee->vacation)?$employee->vacation:''}}">
                        </div>

                        <div class="form-group">
                            <div>

                                @if(isset($employee->id))
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Update Employee
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Add Employee
                                    </button>
                                @endif
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
