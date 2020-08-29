@extends('layouts.app')
@section('title','Product')
@section('page_title','Product')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('product.index')}}">Product</a>
    </li>
    <li class="breadcrumb-item active">
        Product Barcode Print
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                        <h4 class="mt-0 header-title">Product  Barcode Print</h4>
                    <form class="product_search_for_print" id="k">
                        <input type="hidden" class="success_url" value="{{url('admin/brand')}}">
                        <input type="hidden" class="submit_url" value="{{url('admin/brand/store')}}">
                        <input type="hidden" class="method" value="POST">
                        <input type="hidden" class="id" name="id" value="">
                        @csrf
                        @csrf
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control  border_radius" name="product_name" id="productName" value="{{isset($product->name)?$product->name : ''}}">
                                </div>
                                <button class="btn btn-primary" id="search_pro"> Search Product</button>
                            </div>
                        </div>
                    </form>
                    <form  method="post" action="{{url('product/barcode/preview')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <table class="table">
                                    <tr>
                                        <td>Products</td>
                                        <td>No.of Labels</td>
                                    </tr>
                                    <tbody id="productTable">

                                    </tbody>
                                </table>

                                <div class="form-group mt-2">
                                    <strong>Print: </strong>&nbsp;
                                    <strong><input type="checkbox" name="name" checked=""> Product Name</strong>&nbsp;
                                    <strong><input type="checkbox" name="price" checked=""> Price</strong>&nbsp;
                                </div>

                                    <div class="col-md-4">
                                        <label><strong>Paper Size *</strong></label>
                                        <select class="form-control" name="paper_size" required="" id="paper-size" tabindex="-98">
                                            <option value="0">Select paper size...</option>
                                            <option value="36">36 mm (1.4 inch)</option>
                                            <option value="24">24 mm (0.94 inch)</option>
                                            <option value="18">18 mm (0.7 inch)</option>
                                        </select>
                                    </div>
                                <button class="btn btn-primary" id="submit-button" >Submit </button>
                                </div>
                        </div>

                    </form>



                </div>
                <div id="print-barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="modal_header" class="modal-title">{{trans('file.Barcode')}}</h5>&nbsp;&nbsp;
                                <button id="print-btn" type="button" class="btn btn-default btn-sm"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
                                <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div id="label-content">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@section('footerScripts')
    @parent
    <script src="{{asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(document).on('submit', '.product_search_for_print', function(e) {
            e.preventDefault();
            var submit_url = $(this).attr("submit_url");
            var success_url = $(this).attr("success_url");
            var data = new FormData(document.getElementById("k"));
            $.ajax({
                method: 'POST',
                url:"{{url('product/print-barcode')}}",
                data:data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    var html = '<tr>\n' +
                        '    <td>'+result.name+'</td>\n' +
                        '    <td><input name="qty" value="1" /></td>\n' +
                        '    <td><input type="hidden" name="barcode" value="'+result.barcode+'" /></td>\n' +
                        '    \n' +
                        '</tr>'
                    $("#productTable").append(html);

                },
            });
        });


    </script>

@stop
