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
                                <td>
                                    <a href="{{route('brand.edit',$brand->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                    @if($brand->status == 'Inactive')
                                        <a href="{{route('brand.active',$brand->id)}}" class="btn btn-warning" title="Make Active"><i class="fas fa-arrow-circle-down"></i></a>
                                    @else
                                        <a href="{{route('brand.inactive',$brand->id)}}" class="btn btn-success" title="Make Inactive"><i class="fas fa-arrow-circle-up"></i></a>
                                    @endif
                                    <a href="{{route('brand.delete',$brand->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>
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
@stop
