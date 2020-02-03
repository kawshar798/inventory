@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Expense')
@section('page_title','Expense')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('expense.index')}}">Expense</a>
    </li>
    <li class="breadcrumb-item active">
        Expense   List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
                        Expense Create
                    </button>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Details</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Month</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $index=>$expense)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$expense->details}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{$expense->date}}</td>
                                <td>{{$expense->month}}</td>
                                <td>
                                    <a href="{{route('brand.edit',$expense->id)}}" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{$expense->id}}"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-danger" onclick="deletebrand({{ $expense->id }})"><i class="fa fa-trash"></i></a>

                                    <form id="delete-brand-{{ $expense->id }}" action="{{route('brand.delete',$expense->id)}}" method="post" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>

                            </tr>

                            <!-- Edit  Brand -->
                            <div class="modal" id="editModal-{{$expense->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit  Brand</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{route('brand.update')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control"  value="{{$expense->id}}" name="id">
                                                <div class="form-group">
                                                    <label class="col-form-label">Brand Name</label>
                                                    <input type="text" class="form-control"  placeholder="Enter Brand  Name" name="name" value="{{$expense->name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label">Brand Logo</label>
                                                    <input type="file" class="form-control"  placeholder="Enter Brand  Logo" name="logo" value="{{$expense->logo}}">
                                                    @if($expense->logo)
                                                        <img src="{{asset($expense->logo)}}" alt="{{$expense->name}}" style="width: 100px;height: 100px;"/>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label">Brand Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="">Select One</option>
                                                        <option value="Active" @isset($expense->status){{$expense->status=='Active'?'Selected' : ''}} @endif >Active</option>
                                                        <option value="Inactive" @isset($expense->status){{$expense->status=='Inactive'?'Selected' : ''}} @endif >Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- Create  Brand -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Create Expense</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{route('expense.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-form-label">Expense  Details</label>
                                     <textarea class="form-control" rows="5" cols="10" name="details"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Amount</label>
                                        <input type="text" class="form-control"  placeholder="Enter Expense Amount" name="amount">
                                    </div>
                               <input type="hidden" name="date" value="{{date("d/m/y")}}">
                               <input type="hidden" name="month" value="{{date("F")}}">
                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
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
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deletebrand(id) {
            swal({
                title: 'Are you sure delete this Brand?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-2',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-brand-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>


@stop
