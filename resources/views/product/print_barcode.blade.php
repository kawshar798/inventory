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
                    <form class="" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" onsubmit="return bracode_validate()" >
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Product Name</label>
                                <input type="text" class="form-control  border_radius" name="name" id="productName" value="{{isset($product->name)?$product->name : ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit_btn">
                                        Add Product
                                    </button>
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
