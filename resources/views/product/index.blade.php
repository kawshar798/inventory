@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />


@endpush
@section('title','Product')
@section('page_title','Product')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('product.index')}}">Product</a>
    </li>
    <li class="breadcrumb-item active">
        Product   List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <a href="{{route('product.create')}}" class="btn btn-primary mb-3" >Product  Create</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>Brand</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Alert Quantity</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $index=>$product)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$product->name}}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{asset($product->image)}}" width="80px" alt="product Image"/>
                                        @else
                                        N/A
                                        @endif


                                </td>
                                <td>{{isset($product->category_id)?$product->category->name:''}}</td>
{{--                                <td>{{isset($product->sub_category_id)?$product->subcategory->name:''}}</td>--}}
                                <td>{{isset($product->brand_id)?$product->brand->name:''}}</td>
                                <td>{{ isset($product->unit_id)?$product->unit->name:''}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->alert_quantity}}</td>
                                <td>
                                @if($product->featured == 0)
                                        N/A
                                    @else
                                  Yes
                                    @endif
                                </td>
                                <td>
                                    @if($product->status == 'Inactive')
                                        <span class="badge badge-warning ">Inactive</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i> Edit</a>
                                    @if($product->status == 'Inactive')
                                        <button  data-success_url="{{url('product/list')}}" data-token="{{ csrf_token() }}" data-url="{{ url('product/active', $product->id) }}" class="btn btn-success active_product"
                                                 data-id="{{ $product->id }}"  title="Inactive">Active</button>
                                    @else
                                        <button  data-success_url="{{url('product/list')}}" data-token="{{ csrf_token() }}" data-url="{{ url('product/inactive', $product->id) }}" class="btn btn-warning inactive_product"
                                                 data-id="{{ $product->id }}"  title="Active">Inactive</button>
                                    @endif
                                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
                                    <button  data-success_url="{{url('product/list')}}" data-token="{{ csrf_token() }}" data-url="{{ url('product/delete', $product->id) }}" class="btn btn-danger delete_product"
                                             data-id="{{ $product->id }}"  title="Delete"><i class="fa fa-trash"></i> Delete</button>
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
    // product Active
    $(document).on('click', '.active_product', function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        var url = $(this).data("url");
        var success_url = $(this).data("success_url");
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title:"Are You Sure Active this?",
            // text: " ",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.ajax(
                    {
                        url: url,
                        success_url:success_url,
                        type: 'PUT',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.messege);
                                // setTimeout(function(){
                                location.reload(success_url);
                                // },  2000);
                            } else {
                                toastr.error(result.messege);
                            }
                        },
                    });
            }
        });
    });

    // product Inactive
    $(document).on('click', '.inactive_product', function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        var url = $(this).data("url");
        var success_url = $(this).data("success_url");
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title:"Are You Sure Inactive this?",
            // text: " ",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.ajax(
                    {
                        url: url,
                        success_url:success_url,
                        type: 'PUT',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.messege);
                                // setTimeout(function(){
                                location.reload(success_url);
                                // },  2000);
                            } else {
                                toastr.error(result.messege);
                            }
                        },
                    });
            }
        });
    });

    // product Delete
    $(document).on('click', '.delete_product', function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        var url = $(this).data("url");
        var success_url = $(this).data("success_url");
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title:"Are You Sure Delete this?",
            // text: " ",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.ajax(
                    {
                        url: url,
                        success_url:success_url,
                        type: 'DELETE',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.messege);
                                // setTimeout(function(){
                                location.reload(success_url);
                                // },  2000);
                            } else {
                                toastr.error(result.messege);
                            }
                        },
                    });
            }
        });
    });

</script>


@stop
