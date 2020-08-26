@extends('layouts.pos_app')
@push('head_styles')
    <style>
        .col-md-3.product-list {
            display: flex;
            /* padding-left: 1px; */
        }

        .product-box {
            /* margin-left: -8px; */
            /* height: 300px; */
            background: white;
            width: 300px;
            margin-top: 10px;
            padding: 10px;
            border-radius: 3px;
            box-shadow: 0 1px 0px rgba(0,0,0,0.11), 0 1px 4px rgba(0, 0, 0, 0.11), 0 3px 2px rgb(0 0 0 / 0.11);
        }

        .product-box {}

        .prodcut_img img {
            max-width: 100%;
            width: 100%;
            height: auto;
        }

        .prodcut_img {
            height: 100px;
            width: 100px;
            text-align: center;
            margin: 0 auto;
        }

        h3.product_name {
            font-size: 12px;
            text-align: center;
            margin: 0px;
            margin-top: 15px;
        }

        p.product_price {
            font-size: 12px;
            text-align: center;
            margin: 0;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="example@example.com">
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary  ">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="category" onchange="myFunction()">
                    <option value="all">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-control" onchange="myFunction()" id="brand">
                        <option value="all">All Categories</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row" id="products">
                <div class="col-md-3 product-list">
                    <div class="product-box">
                        <div class="prodcut_img">
                            <img src="" />
                        </div>
                        <h3 class="product_name"></h3>
                        <p class="product_price"></p>
                    </div>
                </div>
            </div>
{{--            @forelse($products as $product)--}}

{{--            @empty--}}

{{--            @endforelse--}}



        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('footerScripts')
    <script>


        function myFunction() {
            var categoryId = $('#category :selected').val();
            var brandId = $('#brand :selected').val();
            var param = {};
            param['categoryId'] = categoryId;
            param['brandId'] = brandId;
            $.ajax({
                url: "pos/get/product",
                method: 'get',
                data: param,
                success: function (data) {

                    console.log(data)
                    var html = "";
                    $.each(data, function (index, value) {
                        console.log(value.name);
                        html += "<div class=\"col-md-3 product-list\" onclick=\"productAdd(" + value.id + ")\">\n" +
                            "                                        <div class=\"product-box\">\n" +
                            "                                        <div class=\"prodcut_img\">\n" +
                            "                                            <img  src=\"" + value.image + "\"\n" +
                            "                                                 >\n" +
                            "                                            <hr>\n" +
                            "                                            </div>\n" +
                            "                                                <h3 class=\"product_name\">" + value.name  + "</h3>\n" +
                            "                                                <p class=\"product_name\">" + value.mrp + "</p>\n" +
                            "                                            </div>\n" +
                            "                                    </div>";
                    });
                    $('#products').empty();
                    $('#products').append(html);

                }

            });
        }


    </script>
    @parent

@stop
