@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Brand')
@section('page_title','Brand')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('category.index')}}">Brand</a>
    </li>
    <li class="breadcrumb-item active">
        Brand   List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
                        Brand Create
                    </button>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $index=>$brand)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$brand->name}}</td>
                                <td>{{$brand->slug}}</td>
                                <td>
                                    <img src="{{asset($brand->logo)}}" alt="{{$brand->name}}" style="height: 100px;width: 100px;">
                                </td>
                                <td>{{$brand->status}}</td>

                                <td>
                                    <a href="{{route('brand.edit',$brand->id)}}" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{$brand->id}}"><i class="fas fa-pencil-alt"></i></a>
                                    @if($brand->status == 'Inactive')
                                        <a href="{{route('brand.active',$brand->id)}}" class="btn btn-warning" title="Make Active" onclick="return confirm('Are you sure Active this brand????')"><i class="fas fa-arrow-circle-down"></i></a>
                                    @else
                                        <a href="{{route('brand.inactive',$brand->id)}}" class="btn btn-success" title="Make Inactive" onclick=" return confirm('Are you sure Active this brand????')"><i class="fas fa-arrow-circle-up"></i></a>
                                    @endif
                                    <a href="#" class="btn btn-danger" onclick="deletebrand({{ $brand->id }})"><i class="fa fa-trash"></i></a>

                                    <form id="delete-brand-{{ $brand->id }}" action="{{route('brand.delete',$brand->id)}}" method="post" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>

                            </tr>

                            <!-- Edit  Brand -->
                        <div class="modal" id="editModal-{{$brand->id}}">
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
                                            <input type="hidden" class="form-control"  value="{{$brand->id}}" name="id">
                                            <div class="form-group">
                                                <label class="col-form-label">Brand Name</label>
                                                <input type="text" class="form-control"  placeholder="Enter Brand  Name" name="name" value="{{$brand->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Brand Logo</label>
                                                <input type="file" class="form-control"  placeholder="Enter Brand  Logo" name="logo" value="{{$brand->logo}}">
                                                @if($brand->logo)
                                                    <img src="{{asset($brand->logo)}}" alt="{{$brand->name}}" style="width: 100px;height: 100px;"/>
                                                    @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Brand Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Select One</option>
                                                    <option value="Active" @isset($brand->status){{$brand->status=='Active'?'Selected' : ''}} @endif >Active</option>
                                                    <option value="Inactive" @isset($brand->status){{$brand->status=='Inactive'?'Selected' : ''}} @endif >Inactive</option>
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
                                <h4 class="modal-title">Create Brand</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                               <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
                                   @csrf
                                   <div class="form-group">
                                      <label class="col-form-label">Brand Name</label>
                                       <input type="text" class="form-control"  placeholder="Enter Brand  Name" name="name">
                                   </div>
                                       <div class="form-group">
                                           <label class="col-form-label">Brand Logo</label>
                                           <input type="file" class="form-control"  placeholder="Enter Brand  Logo" name="logo">
                                       </div>
                                   <div class="form-group">
                                       <label class="col-form-label">Brand Status</label>
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
