@extends('layouts.app')
@section('title','Employee')
@section('page_title','Employee')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('employee.index')}}">Employee</a>
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
        <div class="col-lg-6 offset-md-3">
            <div class="card m-b-30">
                <div class="card-body">
                    @if(isset($employee->id))
                        <h4 class="mt-0 header-title">Employee Update</h4>
                        @else
                        <h4 class="mt-0 header-title">Employee Create</h4>
                        @endif
                    <form class="" action="{{route('employee.create')}}" novalidate="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input value="{{isset($employee->id)?$employee->id:''}}" name="id" type="hidden">
                        <div class="form-group row">
                            <label class=" col-md-3">Name</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Name" name="name" value="{{isset($employee->name)?$employee->name:''}}">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Email</label>
                            <input type="email" class="form-control col-md-8"  placeholder="Enter email" name="email"  value="{{isset($employee->email)?$employee->email:''}}">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">phone</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Phone" name="phone"  value="{{isset($employee->phone)?$employee->phone:''}}">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">City</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter city" name="city" value="{{isset($employee->city)?$employee->city:''}}">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">NID No.</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter NID No." name="nid_no" value="{{isset($employee->nid_no)?$employee->nid_no:''}}">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Vacation</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter vacation" name="vacation" value="{{isset($employee->vacation)?$employee->vacation:''}}">
                        </div>

                        <div class="form-group row">
                            <label class=" col-md-3">Address</label>
                            <textarea name="address" class="form-control col-md-8">{{isset($employee->address)?$employee->address:''}}</textarea>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Photo</label>
                            <input type="file" class="form-control col-md-8"  placeholder="Enter city" name="photo" value="{{isset($employee->photo)?$employee->photo:''}}">
                            @if(isset($employee->photo))

                                <img src="{{url($employee->photo)}}" style="height: 100px;width: 100px;" class="offset-md-3">
                                @endif
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Salary</label>
                            <input type="number" class="form-control col-md-8"  placeholder="Enter Salary" name="salary" value="{{isset($employee->salary)?$employee->salary:''}}">
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-3">Experience</label>
                            <input type="text" class="form-control col-md-8"  placeholder="Enter Salary" name="experience" value="{{isset($employee->experience)?$employee->experience:''}}">

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
