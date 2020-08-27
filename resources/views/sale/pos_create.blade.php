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
        .total_summary {
            background: #02c58d;
            color: #fff;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0px 10px;
        }

        .return h2 {
            font-size: 24px;
        }

        .sale_summary {
            border-top: 1px solid #02c58d;
            padding-top: 10px;
            /* padding-bottom: 18px; */
        }
        .product_order_summary_table{
            min-height: 400px;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
<div class="pos_header_right">
    <!-- full screen -->
    <ul class="navbar-right list-inline float-right mb-0">
    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block" title="Full Screen">
        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
            <i class="mdi mdi-arrow-expand-all noti-icon"></i>
        </a>
    </li>
   <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
       <a href="{{route('home')}}" class="btn btn-danger" title="Cancle Pos Srceen"><i class="fas fa-times"></i></a>
    </li>

    <li class="dropdown notification-list list-inline-item">
        <div class="dropdown notification-list nav-pro-img">
            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              Admin  <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> Wallet</a>
                <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i> Settings</a>
                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock screen</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#"><i class="mdi mdi-power text-danger"></i> Logout</a>
            </div>
        </div>
    </li>
    </ul>


</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="product_order_summary_table">
                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                   id="kt_table_1">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Sub Price</th>
                                    <th> <i class="fa fa-trash text-danger"></i></th>
                                </tr>
                                </thead>
                                <tbody id="productTable">

                                </tbody>

                            </table>

                        </div>

                        <div class="sale_summary">
                    <div class="row">
                        <div class="col-sm-4">
                            <span class="summary_title">Items</span>
                            <span  id="total_item">0</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="summary_title">Total</span>
                            <span  id="totalPrice">0</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="summary_title"> Discount
                                  <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-discount">
                               <i class="fas fa-pencil-alt"></i><span id="discount"></span></button>
                            </span>
                            <span  id="item">0</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="summary_title">Coupon
                                  <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-discountd">
                                <i class="fas fa-pencil-alt"></i></button>
                            </span>
                            <span  id="item">0</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="summary_title"> Tax
                                  <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-tax">
                                <i class="fas fa-pencil-alt"></i></button>
                            </span>
                            <span  id="tax">0</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="summary_title"> Shipping
                                  <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#shipping-cost-modal">
                                <i class="fas fa-pencil-alt"></i></button>
                            </span>
                            <span  id="shippingcost"></span>
                        </div>
                        <div class="col-md-12">
                         <div class="total_summary">
                             <div class="return">
                                 <h5>Return <span>123</span></h5>
                             </div>
                             <div class="return">
                                 <h2>Grand Total <span id="grandtotalPrice"></span></h2>
                             </div>
                         </div>
                        </div>
                    </div>

                        </div>















                        <div id="order-discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Order Discount</h5>
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" name="order_discount" class="form-control numkey" >
                                        </div>
                                        <button type="button" name="order_discount_btn"  class="btn btn-primary" data-dismiss="modal">Discount</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- coupon modal -->
{{--                        <div id="coupon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">--}}
{{--                            <div role="document" class="modal-dialog">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h5 class="modal-title">{{trans('file.Coupon Code')}}</h5>--}}
{{--                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <input type="text" id="coupon-code" class="form-control" placeholder="Type Coupon Code...">--}}
{{--                                        </div>--}}
{{--                                        <button type="button" class="btn btn-primary coupon-check" data-dismiss="modal">{{trans('file.submit')}}</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- order_tax modal -->
                        <div id="order-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Order Tax</h5>
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="order_tax_rate">
                                            <select class="form-control" name="order_tax_rate_select">
                                                <option value="0">No Tax</option>
                                                @foreach($taxs as $tax)
                                                    <option value="{{$tax->amount}}">{{$tax->name}}{{$tax->type == 'Percentage'?'%':''}}{{$tax->type == 'Fixed'?'%':'৳'}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <button type="button" name="order_tax_btn" class="btn btn-primary" data-dismiss="modal">submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- shipping_cost modal -->
                        <div id="shipping-cost-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Shipping Cost</h5>
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" name="shipping_cost" class="form-control numkey" step="any">
                                        </div>
                                        <button type="button" name="shipping_cost_btn" class="btn btn-primary" data-dismiss="modal">submit</button>
                                    </div>
                                </div>
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
            </div>
{{--            @forelse($products as $product)--}}

{{--            @empty--}}

{{--            @endforelse--}}



        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('footerScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                    var html = "";
                    $.each(data, function (index, value) {
                        console.log(value.name);
html += "      <div class=\"col-md-3 product-list\" onclick=\"productAdd(" + value.id + ")\">\n" +
    "                    <div class=\"product-box\">\n" +
    "                        <div class=\"prodcut_img\">\n" +
    "                            <img src=\"\" />\n" +
    "                        </div>\n" +
    "                        <h3 class=\"product_name\"></h3>\n" +
    "                        <p class=\"product_price\"></p>\n" +
    "                    </div>\n" +
    "                </div>"
                    //     html += "<div class=\"col-md-3 product-list\" onclick=\"productAdd(" + value.id + ")\">\n" +
                    //         "                                        <div class=\"product-box\">\n" +
                    //         "                                        <div class=\"prodcut_img\">\n" +
                    //         "                                            <img  src=\"" + value.image + "\"\n" +
                    //         "                                                 >\n" +
                    //         "                                            <hr>\n" +
                    //         "                                            </div>\n" +
                    //         "                                                <h3 class=\"product_name\">" + value.name  + "</h3>\n" +
                    //         "                                                <p class=\"product_name\">" + value.mrp + "</p>\n" +
                    //         "                                            </div>\n" +
                    //         "                                    </div>";
                    });
                    $('#products').empty();
                    $('#products').append(html);

                }

            });
        }
        //click the product from product gallery
        function productAdd(id) {
            forSearchPur(id);
        }
        var ids = [];
        //get the product
        function forSearchPur(id = 0) {
            // debugger
            var flus = false;
            var proId = id;
            if (proId == 0) {
                proId = $('.data :selected').val();
            }
            $.ajax({
                url: "pos/single/product/" + proId,
                method: 'get',
                success: function (data) {


                    //check if product have stock
                    if (data.quantity == null) {
                        // $('#kt_sweetalert_demo_3_2').show();
                        alert("Stock Out");
                    } else {
                        //check if id have in array product quantity price  is ++
                        console.log(data);
                        var index = ids.indexOf(data.id);
                        flus = index != -1 ? true : false;
                        // $(".data option:selected").prop("selected", false)
                        $(".data option:selected").removeAttr("selected");
                        if (flus) {
                            var q = $("#proQuantity-" + data.id).val();
                            $("#proQuantity-" + data.id).val(parseInt(q) + 1);
                            proMultiPur(data.id);
                        } else {
                            var html = '<tr id="pro-' + data.id + '">\n' +
                                '                                            <td><p id="proName" class="text-primary">' + data.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"></td>\n' +
                                '                                            <td><input id="proQuantity-' + data.id + '" class="form-control" type="number" min="0" max="' + data.quantity + '" onchange="proMultiPur(' + data.id + ')" id="proQuantity-' + data.id + '" name="proQuantity[]" value="1"></td>\n' +
                                '                                            <td>\n' +
                                '                                                <div  class="form-control"><span id="proUnitPrice-' + data.id + '">' + data.mrp + '</span > </div>\n' +
                                '                                            </td>\n' +
                                '                                            <td>\n' +
                                '                                                <div class="form-control"> <span id="proSubPrice-' + data.id + '">' + data.mrp + '</span></div>\n' +
                                '                                            </td>\n' +
                                '                                            <td>\n' +
                                '                                                <a  onclick="removeProductPur(' + data.id + ')" class="kt-nav__link pointer">\n' +
                                '                                                   <i class="fa fa-trash"></i>\n' +
                                '                                                </a>\n' +
                                '\n' +
                                '                                            </td>\n' +
                                '                                        </tr>';
                            $("#productTable").append(html);
                            ids.push(data.id);
                        }
                        totalPur();
                    }

                }
            })
        }
        //remove the product
        function removeProductPur(id) {
            $("#pro-" + id).remove();
            var index = ids.indexOf(id);
            ids.splice(index, 1);
            //add option
            $.ajax({
                url: "pos/single/product/" + id,
                method: 'get',
                success: function (data) {
                    $('.data').append("<option value=" + data.id + ">" + data.name + "" + (data.code) + "</option>");
                }

            });
            totalPur();
        }
        //multiply the product
        function proMultiPur(id) {
            var quantity = $("#proQuantity-" + id).val();
            var price = $("#proUnitPrice-" + id).text();
            var subPrice = quantity * price;
            $("#proSubPrice-" + id).text(subPrice);
            totalPur();
        }
        //Order Discount
        $('button[name="order_discount_btn"]').on("click", function() {
            totalPur();
        });
        //Shipping Cost
        $('button[name="shipping_cost_btn"]').on("click", function() {
            totalPur();
        });
        //Order Tax
        $('button[name="order_tax_btn"]').on("click", function() {
            totalPur();
        });
        //total product price
        function totalPur() {
            var total = 0;
            var item = 0;
            var order_discount = parseFloat($('input[name="order_discount"]').val());
            var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
            var order_tax = parseFloat($('select[name="order_tax_rate_select"]').val());
        // debugger
            if (!order_discount)
                order_discount = 0.00;
            $("#discount").text(order_discount.toFixed(2));
            if (!shipping_cost)
                shipping_cost = 0.00;
            $("#shippingcost").text(shipping_cost.toFixed(2));

            if (!order_tax)
                order_tax = 0.00;

            $.each(ids, function (index, value) {
                var subPrice = parseFloat($("#proSubPrice-" + value).text());
                total = total + subPrice ;
                var quantity = $("#proQuantity-" + value).val();
                item = item + parseInt(quantity);
            });
            order_tax = (total - order_discount) * (order_tax / 100);
            $("#tax").text(order_tax.toFixed(2));
            var grandTotal = (total + shipping_cost + order_tax) - order_discount;
            $("#totalPrice").text(parseFloat(total));
            $("#grandtotalPrice").text(parseFloat(grandTotal));
            $("#total_item").text(parseInt(item));
        }



    </script>
    @parent

@stop
