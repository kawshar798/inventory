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

                    <select   id="category" onchange="myFunction()" >
                        <option value="all">All Select</option>
                       @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                           @endforeach
                    </select>
                    <select class="band"  onchange="myFunction()" id="brand">
                        <option value="all">All Select</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>SubCategory Name</th>
                            <th>Brand</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Alert Quantity</th>
                            <th>Featured</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $index=>$product)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->image}}</td>
                                <td>{{$product->category_id}}</td>
                                <td>{{$product->sub_category_id}}</td>
                                <td>{{$product->brand_id}}</td>
                                <td>{{$product->unit_id}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->alert_quantity}}</td>
                                <td>{{$product->featured}}</td>
                                <td>{{$product->featured}}</td>
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
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script type="text/javascript">
        function deleteInstitute(id) {
            swal({
                title: 'Are you sure delete this Category?',
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
                    document.getElementById('delete-form-'+id).submit();
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

        // $(document).ready(function() {
        //
        //     function myFunction() {
        //         var categoryId = $('#category :selected').val();
        //         var brandId = $('#brand :selected').val();
        //         var param = {};
        //         console.log(categoryId)
        //         param['categoryId'] = categoryId;
        //         param['brandId'] = brandId;
        //         $.ajax({
        //             url: "product",
        //             method: 'get',
        //             data: param,
        //             success: function (data) {
        //
        //                 console.log(data)
        //                 // var html = "";
        //                 // $.each(data, function (index, value) {
        //                 //     html += "<div class=\"col-4 p-1 pointer\" onclick=\"productAdd(" + value.id + ")\">\n" +
        //                 //         "                                        <div class=\"card p-2\">\n" +
        //                 //         "                                            <img class=\"card-img-top\" src=\"" + value.image + "\"\n" +
        //                 //         "                                                 height=\"100\">\n" +
        //                 //         "                                            <hr>\n" +
        //                 //         "                                            <div>\n" +
        //                 //         "                                                <p>" + value.name + "" + (value.code) + "</p>\n" +
        //                 //         "                                                Price : <span>" + value.price + "</span>\n" +
        //                 //         "                                            </div>\n" +
        //                 //         "                                        </div>\n" +
        //                 //         "                                    </div>";
        //                 // });
        //                 // $('#products').empty();
        //                 // $('#products').append(html);
        //
        //             }
        //
        //         });
        //     }
        //
        // });
    </script>
    <script>


            function myFunction() {
                var categoryId = $('#category :selected').val();
                var brandId = $('#brand :selected').val();
                var param = {};
                console.log(categoryId)
                param['categoryId'] = categoryId;
                param['brandId'] = brandId;
                $.ajax({
                    url: "products",
                    method: 'get',
                    data: param,
                    success: function (data) {

                        console.log(data)
                        // var html = "";
                        // $.each(data, function (index, value) {
                        //     html += "<div class=\"col-4 p-1 pointer\" onclick=\"productAdd(" + value.id + ")\">\n" +
                        //         "                                        <div class=\"card p-2\">\n" +
                        //         "                                            <img class=\"card-img-top\" src=\"" + value.image + "\"\n" +
                        //         "                                                 height=\"100\">\n" +
                        //         "                                            <hr>\n" +
                        //         "                                            <div>\n" +
                        //         "                                                <p>" + value.name + "" + (value.code) + "</p>\n" +
                        //         "                                                Price : <span>" + value.price + "</span>\n" +
                        //         "                                            </div>\n" +
                        //         "                                        </div>\n" +
                        //         "                                    </div>";
                        // });
                        // $('#products').empty();
                        // $('#products').append(html);

                    }

                });
            }


    </script>
@stop
