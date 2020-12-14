@extends('layouts.app')
@section('title','Return Sale ')
@section('page_title','Return Sale ')
@push('head_styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <style>
        .card-body.p_relative {
            position: relative;
        }

        .card-body.p_relative:after {
            position: absolute;
            background: #30419b;
            height: 2px;
            width: 100%;
            content: "";
            left: 0;
            top: -10px;
            border-radius: 10px;
        }
        #cheque_number{
            display: none;
        }
    </style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href=""> Return Sale</a>
    </li>
    <li class="breadcrumb-item active">
       Return Sale list
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-30">
                <div class="card-body p_relative">
                    <h4 class="mt-0 header-title"> Return Sale list</h4>
                <form>
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4 ">
                            <label class="">Customer Name<abbr style="color: red">*</abbr></label>
                            <select name="customer_id" class="form-control customer_list">
                                <option>Select Customer</option>
                                @foreach($invoices as $item)
                                    <option value="{{$item->invoice_no}}">{{$item->invoice_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label class="">Sale Invoice No</label>
                            <input name="invoice_number" class="form-control" />
                        </div>
                        <div class="col-md-4 ">
                            <label class="">Date<abbr style="color: red">*</abbr></label>
                            <input name="date" class="form-control" id="date"/>
                        </div>
                    </div>
                        <hr/>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2 ">
                            <label class="">Customer Name<abbr style="color: red">*</abbr></label>
                            <select name="customer_id" class="form-control customer_list">
                                <option>Select Customer</option>
                                @foreach($invoices as $item)
                                    <option value="{{$item->invoice_no}}">{{$item->invoice_no}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="myTable" class="table table-hover order-list">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>Quantity</th>
                            <th class="recieved-product-qty d-none">Received</th>
                            <th>Discount</th>
                            <th>Net Unit Cost</th>
                            <th>Subtotal</th>
                            <th><i class="fa fa-trash"></i></th>
                        </tr>
                        </thead>
                        <tbody id="productTable">
                        </tbody>
                        <tfoot class="tfoot active">
                        <th>Total</th>
                        <th id="total-qty" colspan="2">0</th>
                        <th id="total-discount">0</th>
                        <th class="recieved-product-qty d-none"></th>
                        <th id="total"  align="center">0.00</th>
                        <th><i class="fa fa-trash"></i></th>
                        </tfoot>
                    </table>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">Return Note</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <table class="table table-bordered table-condensed totals">
                            <tbody><tr><td><strong>Items</strong>
                                    <span class="pull-right" id="total_main_item">0</span>(<span id="total_item">0</span>)
                                </td>
                                <td><strong>Total</strong>
                                    <span class="pull-right" id="subtotal">0.00</span>
                                </td>
                                <td><strong>Tax</strong>
                                    <span class="pull-right" id="order_tax">0.00</span>
                                </td>
{{--                                <td><strong>Order Discount</strong>--}}
{{--                                    <span class="pull-right" id="order_discount">0.00</span>--}}
{{--                                </td>--}}
{{--                                <td><strong>Shipping Cost</strong>--}}
{{--                                    <span class="pull-right" id="shipping_cost">0.00</span>--}}
{{--                                </td>--}}
{{--                                <td><strong>Paid Amount</strong>--}}
{{--                                    <span class="pull-right" id="paid_amount">0.00</span>--}}
{{--                                </td>--}}
                                <td><strong>Grand Total</strong>
                                    <span class="pull-right" id="grandtotalPrice">0.00</span>
                                </td>
                            </tr></tbody></table>
                    </div>
                </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@section('footerScripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script>


        $(document).ready(function() {
            //Date pikcer
            $(function () {
                $('#date').datetimepicker({

                    format: 'YYYY-MM-DD',
                });
            });
            //Select2
            $(".customer_list").select2({
                tags: true
            });
        });
        //payment method select
        $('#payment_method').on('change', function()
        {
            $payment = this.value;
            if($payment == 'Cheque'){
                $("#cheque_number").css("display", "block");
            }
        });
        var ids = [];
        function forSearchPur() {
            // debugger
            var proId = $('.all_product :selected').val();
            // alert(proId)
            $.ajax({
                // url: "product/get/single/" + proId,
                url: "{{url('product/get/single')}}/"+proId,
                method: 'get',
                success: function (data) {
                    console.log(data);
                    ids.push(data.id);
                    $('.all_product option:selected').remove();
                    var html = '<tr id="pro-' + data.id + '">\n' +
                        '                                            <td><p id="proName" class="text-primary">' + data.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"></td>\n' +
                        '                                            <td><input class="form-control" type="number" min="0" onchange="proMultiPur(' + data.id + ')" id="proQuantity-' + data.id + '" name="proQuantity[]" value="1"></td>\n' +
                        '                                            <td>\n' +
                        '                                                <input type="number" class="form-control" readonly id="proUnitPrice-' + data.id + '"  value="' + data.cost_price + '">\n' +
                        '                                            </td>\n' +
                        '                                            <td>\n' +
                        '                                                <input type="number" class="form-control" readonly id="proSubPrice-' + data.id + '"  value="' + data.cost_price + '" name="prosubTotal[]">\n' +
                        '                                            </td>\n' +
                        '                                            <td>\n' +
                        '                                                <a  onclick="removeProductPur(' + data.id + ')" class="kt-nav__link">\n' +
                        '                                                    <i class="fa fa-trash text-danger"></i>\n' +
                        '                                                </a>\n' +
                        '\n' +
                        '                                            </td>\n' +
                        '                                        </tr>';
                    $("#productTable").append(html);
                    totalPur();
                }
            })
        }
        //removeProduct from purchase product list
        function removeProductPur(id) {
            $("#pro-" + id).remove();
            var index = ids.indexOf(id);
            ids.splice(index, 1);
            //add option
            $.ajax({
                url: "single/product/" + id,
                method: 'get',
                success: function (data) {
                    $('.data').append("<option value=" + data.id + ">" + data.name + "" + (data.code) + "</option>");
                }

            });
            totalPur();
        }
        //multiply the quantity or price on the purchase product
        function proMultiPur(id) {
            var quantity = $("#proQuantity-" + id).val();
            var price = $("#proUnitPrice-" + id).val();
            var subPrice = quantity * price;
            $("#proSubPrice-" + id).val(subPrice);
            $(".in_single_subPrice").val(subPrice);

            totalPur();
        }
        $('input[name="order_discount"]').on("input", function() {
            totalPur();
        });

        //Shipping Cost
        $('input[name="shipping_cost"]').on("input", function() {
            totalPur();
        });

        //Paid Amount
        $('input[name="paid_amount"]').on("input", function() {
            totalPur();
        });


        //Order Tax
        $('select[name="order_tax_rate"]').on("change", function() {
            totalPur();
        });


        //calculate the total price on the purchase
        function totalPur() {
            var item = $('table.order-list tbody tr:last').index();
            item = ++item;
            $('#total_main_item').text(item);

            var total = 0;
            var total_quantity = 0;

            //Order discount
            var order_discount = parseFloat($('input[name="order_discount"]').val());
            if (!order_discount)
                order_discount = 0.00;
            $("#order_discount").text(order_discount.toFixed(2));

            //Shipping Cost
            var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
            if (!shipping_cost)
                shipping_cost = 0.00;
            $("#shipping_cost").text(shipping_cost.toFixed(2));


            var paid_amount = parseFloat($('input[name="paid_amount"]').val());
            console.log(paid_amount);
            if (!paid_amount)
                paid_amount = 0.00;
            $("#paid_amount").text(paid_amount.toFixed(2));

            //Order tax
            var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
            if (!order_tax)
                order_tax = 0.00;

            console.log(ids)
            // $('#order_tax').text(order_tax.toFixed(2));
            $.each(ids, function (index, value) {
                var subPrice = parseFloat($("#proSubPrice-" + value).val());
                var total_qty = parseFloat($("#proQuantity-" + value).val());
                total = total + subPrice;
                total_quantity = total_quantity + total_qty;
            });
            order_tax = (total - order_discount) * (order_tax / 100);
            $("#order_tax").text(order_tax.toFixed(2));
            $("#subtotal").text(parseFloat(total.toFixed(2)));
            var grandTotal = (total + shipping_cost + order_tax) - order_discount;

            $("#total").text(parseFloat(total));
            $("#total-qty").text(parseFloat(total_quantity));
            $("#total_item").text(parseFloat(total_quantity));
            $("#grandtotalPrice").text(parseFloat(grandTotal));

            $(".in_item").val(parseFloat(item));
            $(".in_total_qty").val(parseFloat(total_quantity));
            $(".in_order_discount").val(parseFloat(order_discount));
            $(".in_total_tax").val(parseFloat(order_tax));
            $(".in_shipping_cost").val(parseFloat(shipping_cost));
            $(".in_grand_total").val(parseFloat(grandTotal));
            $(".in_total_cost").val(parseFloat(paid_amount));
            $(".in_paid_amount").val(parseFloat(total));

        }
        //end the purchase


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

    </script>
@stop
