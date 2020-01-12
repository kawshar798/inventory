@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Category')
@section('page_title','Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('category.index')}}">Category</a>
    </li>
    <li class="breadcrumb-item active">
        Category   List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <a href="{{route('category.create')}}" class="btn btn-primary mb-3" >Category  Create</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Parent Category</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $index=>$category)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{isset($category->parent->name)?$category->parent->name:''}}</td>
                                <td>
                                    <img src="{{asset($category->image)}}" alt="{{$category->name}}" style="width: 100px;height: 100px">

                                </td>
                                <td>
                                @if($category->featured==1)
                                        <span class="badge badge-success">YES</span>
                                    @else
                                        <span class="badge badge-danger">NO</span>
                                    @endif

                                </td>
                                <td>
                                    @if($category->status == 'Inactive')
                                       <span class="badge badge-warning badge-pill">Inactive</span>
                                    @else
                                        <span class="badge badge-success badge-pill">Active</span>
                                    @endif


                                </td>
                                <td>
                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                    @if($category->status == 'Inactive')
                                        <a href="{{route('category.active',$category->id)}}" class="btn btn-warning" title="Make Active"><i class="fas fa-arrow-circle-down"></i></a>
                                        @else
                                        <a href="{{route('category.inactive',$category->id)}}" class="btn btn-success" title="Make Inactive"><i class="fas fa-arrow-circle-up"></i></a>
                                        @endif
                                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
