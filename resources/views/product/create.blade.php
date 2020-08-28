@extends('layouts.app')
@section('title','Product')
@section('page_title','Product')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('product.index')}}">Product</a>
    </li>
    <li class="breadcrumb-item active">
        Product Create
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">

                    @if(isset($product->id))
                        <h4 class="mt-0 header-title">Product Update</h4>
                        @else
                        <h4 class="mt-0 header-title">Product Create</h4>
                        @endif


                    <form class="" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" onsubmit="return bracode_validate()" >
                        @csrf
                        <input name="id" value="{{isset($product->id)?$product->id : ''}}" />
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Product Name</label>
                                <input type="text" class="form-control  border_radius" name="name" id="productName" value="{{isset($product->name)?$product->name : ''}}">
                            </div>
                            <div class="col-md-4">
                                <label>Category Name</label>
                                <select id=category class="form-control border_radius " name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @isset($product->category_id){{$product->category_id==$category->id?'selected':''}}@endisset>{{$category->name}}</option>
                                        @endforeach

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Sub Category Name</label>
                                <select id=subcategory class="form-control border_radius " name="sub_category_id">
                                    <option value="">Select Sub Category</option>
                                    @if(isset($sub_categories))
                                    @foreach($sub_categories as $category)
                                        <option value="{{$category->id}}" @isset($product->category_id){{$product->category_id==$category->id?'selected':''}}@endisset>{{$category->name}}</option>
                                    @endforeach
                                        @endif
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Brand Name</label>
                                <select id=parent class="form-control border_radius" name="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" @isset($product->brand_id){{$product->brand_id==$brand->id?'selected':''}}@endisset>{{$brand->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Unit </label>
                                <select id=parent class="form-control border_radius" name="unit_id">
                                    <option value="">Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}" @isset($product->unit_id){{$product->unit_id==$unit->id?'selected':''}}@endisset>{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>SKU </label>

                                <input type="text" class="form-control  border_radius" name="sku" value="{{isset($product->sku)?$product->sku:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Product Cost</label>
                                <input type="text" class="form-control  border_radius" name="cost_price"  value="{{isset($product->cost_price)?$product->cost_price:''}}">
                            </div>
                            <div class="col-md-4">
                                <label>MRP </label>
                                <input type="text" class="form-control  border_radius" name="mrp" value="{{isset($product->mrp)?$product->mrp:''}}">
                            </div>
                            @if(isset($product->id))
                    @else
                                <div class="col-md-4">
                                    <label>Barcode</label>
                                    <div class="input-group">
                                        <input type="text" name="barcode" required="" class="form-control border_radius" id="barcode">
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-info  tooltip-button border_radius "
                                                type="button"
                                                onclick="document.getElementById('barcode').value = generateCode()"
                                                title="Click here to generate random code">Generate
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endif


{{--                            <div class="col-md-4">--}}
{{--                                <label>Product Type </label>--}}
{{--                                <select id=parent class="form-control border_radius" name="type">--}}
{{--                                    <option value="Single">Single</option>--}}
{{--                                    <option value="Variantable">Variantable</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="col-md-4">
                                <label>Barcode Type</label>
                                <select name="barcode_symbology" required class="form-control selectpicker">
                                    <option value="C128">Code 128</option>
                                    <option value="C39">Code 39</option>
                                    <option value="UPCA">UPC-A</option>
                                    <option value="UPCE">UPC-E</option>
                                    <option value="EAN8">EAN-8</option>
                                    <option value="EAN13">EAN-13</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Quantity</label>
                                <input type="text" class="form-control  border_radius" name="quantity" value="{{isset($product->quantity)?$product->quantity:''}}">
                            </div>
                            <div class="col-md-4">
                                <label>Alert Quantity</label>
                                <input type="text" class="form-control  border_radius" name="alert_quantity" value="{{isset($product->alert_quantity)?$product->alert_quantity:''}}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="" style="margin-left: 22px;">
                                    <input class="form-check-input " type="checkbox" id="featured" name="featured" value="1" @isset($product->featured){{$product->featured==1?'checked':''}} @endisset  />Featured Product
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Product Tax</label>
                                <select id=parent class="form-control border_radius" name="tax">
                                    <option value="">Select</option>
                                    @foreach($taxes as $tax)
                                        <option value="{{$tax->id}}" @isset($product->tax_id){{$product->tax_id==$unit->id?'selected':''}}@endisset>{{$tax->name}}</option>
                                        @endforeach

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Image</label>
                                <input type="file" class="form-control  border_radius" name="image" value="{{isset($product->image)?$product->image:''}}">
                                @if(isset($product->image))
                                    <img src="{{asset($product->image)}}"  style="height: 80px;width:80px" id="three"/>
                                @endif
                            </div>


                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Product Details</label>
                                <textarea id="elm1" name="description">{{isset($product->description)?$product->description:''}}</textarea>
                            </div>

                        </div>


                        <div class="form-group">
                            <div>
                                @if(isset($product->id))
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Update Product
                                    </button>
                                @else

                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit_btn">
                                        Add Product
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
@section('footerScripts')
    @parent
    <script src="{{asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>

        $('#category').on('change',function () {
            var catId = $(this).val();
           if(catId){
               $.ajax({
                   url:'/inventory/subcategory/show/'+catId,
                   type:"GET",
                   dataType:"json",
                   success:function (data) {
                       $('#subcategory').empty();
                       $.each(data, function(key, value) {
                           $('#subcategory').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                       });
                   }

               });
           }
        });
        /*generate random product code*/
        var productName = document.getElementById('productName');
        var randomNumber;
        productName.onkeyup = function(){
            randomNumber = productName.value.toUpperCase();
        }

        function generateCode() {
            if(randomNumber){
                return randomNumber.substring(0, 2) + (Math.floor(Math.random()*1000)+ 999);
            }else{
                return Math.floor(Math.random()*90000) + 10000000;
            }
        }
        $(document).ready(function () {
            if($("#elm1").length > 0){
                tinymce.init({
                    selector: "textarea#elm1",
                    theme: "modern",
                    height:300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });


        // $('#submit_btn').on("click", function (e) {
        //     if(validate()){
        //         e.preventDefault();
        //     }else{
        //         return true;
        //     }
        //
        // });

        function bracode_validate() {
            var product_code = $("input[name='barcode']").val();
            var barcode_symbology = $('select[name="barcode_symbology"]').val();
            var exp = /^\d+$/;

            if (!(product_code.match(exp)) && (barcode_symbology == 'UPCA' || barcode_symbology == 'UPCE' || barcode_symbology == 'EAN8' || barcode_symbology == 'EAN13')) {
                alert('Product code must be numeric.');
                return false;
            } else if (product_code.match(exp)) {
                if (barcode_symbology == 'UPCA' && product_code.length > 11) {
                    alert('Product code length must be less than 12');
                    return false;
                } else if (barcode_symbology == 'EAN8' && product_code.length > 7) {
                    alert('Product code length must be less than 8');
                    return false;
                } else if (barcode_symbology == 'EAN13' && product_code.length > 12) {
                    alert('Product code length must be less than 13');
                    return false;
                }
            }
        }

    </script>

@stop
