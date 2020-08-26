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

                    <div>
                        <select class="customer_id">

                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach

                        </select>
                        <button class="btn btn-primary" id="add_cus" data-toggle="modal" data-target="#myModal">Add custoemr</button>
                    </div>




                    <div class="modal contact_modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ url('add/customer') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger add_new_customer" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>













                    <hr>
                    <hr>
                    <hr>
                    <hr>
                    <hr>

                    <br>
                    <br>
                    <br>
                    <br>
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
    <script>
        $(document).ready(function() {

            $(".customer_id").select2({
                tags: true
            });
        });


        $(document).on('click', '.add_new_customer', function() {
            $('.customer_id').select2('close');
            var name = $(this).data('name');
            $('.contact_modal')
                .find('input#name')
                .val(name);

            console.log(name)
            // $('.contact_modal')
            //     .find('select#contact_type')
            //     .val('customer')
            //     .closest('div.contact_type_div')
            //     .addClass('hide');
            // $('.contact_modal').modal('show');
        });
    </script>
@stop
