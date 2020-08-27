@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Unit')
@section('page_title','Unit')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('setting.tax.index')}}">Tax</a>
    </li>
    <li class="breadcrumb-item active">
        Tax   List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
                        Tax Create
                    </button>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($taxes as $index=>$tax)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$tax->name}}</td>
                                <td>
                                @if(!empty($tax->code))
                                        {{$tax->code}}
                                    @else
                                    N/A
                                    @endif

                                </td>
                                <td>
                                @if($tax->type=='Percentage')
                                        {{$tax->amount}}%
                                    @else
                                        {{ number_format($tax->amount,2)}}৳
                                    @endif

                                </td>
                                <td>

                                @if($tax->status == 'Active')

                                <span class="badge  badge-success">{{$tax->status}}</span>
                                @else
                                        <span class="badge  badge-warning">{{$tax->status}}</span>
                                @endif

                                </td>

                                <td>
                                    <a href="{{route('setting.tax.edit',$tax->id)}}" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{$tax->id}}"><i class="fas fa-pencil-alt"></i></a>
                                    @if($tax->status == 'Inactive')
                                        <a href="{{route('setting.tax.active',$tax->id)}}" class="btn btn-warning" title="Make Active" onclick="return confirm('Are you sure Active this Unit????')"><i class="fas fa-arrow-circle-down"></i></a>
                                    @else
                                        <a href="{{route('setting.tax.inactive',$tax->id)}}" class="btn btn-success" title="Make Inactive" onclick=" return confirm('Are you sure Active this Unit????')"><i class="fas fa-arrow-circle-up"></i></a>
                                    @endif
                                    <a href="#" class="btn btn-danger" onclick="deletebrand({{ $tax->id }})"><i class="fa fa-trash"></i></a>

                                    <form id="delete-brand-{{ $tax->id }}" action="{{route('setting.tax.delete',$tax->id)}}" method="post" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>

                            </tr>

                            <!-- Edit  Brand -->
                        <div class="modal" id="editModal-{{$tax->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit  Tax</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{route('setting.tax.update')}}" method="post">
                                            @csrf
                                            <input type="hidden" class="form-control"   name="id" value="{{$tax->id}}">
                                            <div class="form-group">
                                                <label class="col-form-label">Tax Name</label>
                                                <input type="text" class="form-control"   name="name" value="{{isset($tax->name)?$tax->name:''}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Tax Code</label>
                                                <input type="text" class="form-control"   name="code" value="{{isset($tax->code)?$tax->code:''}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Tax Rate </label>
                                                <input type="text" class="form-control"   name="amount" value="{{isset($tax->amount)?$tax->amount:''}}">
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <label class="col-form-label">Tax Type</label>--}}
{{--                                                <select name="type" class="form-control">--}}
{{--                                                    <option value="">Select One</option>--}}
{{--                                                    <option value="Percentage"  @isset($tax->type){{$tax->type=='Percentage'?'Selected':'' }}@endif>Percentage</option>--}}
{{--                                                    <option value="Fixed"   @isset($tax->type){{$tax->type=='Fixed'?'Selected':'' }}@endif>Fixed</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <label class="col-form-label">Tax Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Select One</option>
                                                    <option value="Active"  @isset($tax->status){{$tax->status=='Active'?'Selected':'' }}@endif>Active</option>
                                                    <option value="Inactive" @isset($tax->status){{$tax->status=='Inactive'?'Selected':'' }}@endif>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Update Tax
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
                                <h4 class="modal-title">Create Tax Rate</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                               <form action="{{route('setting.tax.store')}}" method="post">
                                   @csrf
                                   <div class="form-group">
                                      <label class="col-form-label">Tax Name</label>
                                       <input type="text" class="form-control"  placeholder="Enter Tax  Name" name="name">
                                   </div>
                                   <div class="form-group">
                                       <label class="col-form-label">Tax Code</label>
                                       <input type="text" class="form-control"  placeholder="Enter Tax  code" name="code">
                                   </div>
                                   <div class="form-group">
                                       <label class="col-form-label">Tax Rate</label>
                                       <input type="text" class="form-control"  placeholder="Enter Tax  Rate" name="amount">
                                   </div>
                                   <div class="form-group">
                                       <label class="col-form-label">Tax Type</label>
                                       <select name="type" class="form-control">
                                           <option value="">Select One</option>
                                           <option value="Percentage" >Percentage</option>
                                           <option value="Fixed">Fixed</option>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label class="col-form-label">Tax Status</label>
                                       <select name="status" class="form-control">
                                           <option value="">Select One</option>
                                           <option value="Active" >Active</option>
                                           <option value="Inactive">Inactive</option>
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
                title: 'Are you sure delete this Unit?',
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
