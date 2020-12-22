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
        <a href=""> Return Purchase</a>
    </li>
    <li class="breadcrumb-item active">
       Return Purchase list
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-30">
                <div class="card-body p_relative">
                    <h4 class="mt-0 header-title"> Return Purchase list</h4>
                <form action="{{url('purchase/return/product/store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4 ">
                            <label class="">Supplier Name<abbr style="color: red">*</abbr></label>
                            <select name="supplier_id" class="form-control customer_list">
                                <option>Select Supplier</option>
                                @foreach($suppliers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}({{$item->phone}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label class="">Purchase Invoice No</label>
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
                            <label class="">Product  Name<abbr style="color: red">*</abbr></label>
                            <select name="product_id" class="form-control all_product" onchange="forSearchPur()">
                                <option>Select Product</option>
                                @foreach($products as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="myTable" class="table table-hover salereturn-list">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>Quantity</th>
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
                        <th id="total"  align="center">0.00</th>
                        <th><i class="fa fa-trash"></i></th>
                        </tfoot>
                    </table>

                    <input name="in_item"  class="in_item" type="hidden"/>
                    <input name="in_total_qty"  class="in_total_qty" type="hidden"/>
                    <input name="in_total_tax"  class="in_total_tax" type="hidden"/>
                    <input name="in_total_cost"  class="in_total_cost" type="hidden"/>
                    <input name="in_order_discount"  class="in_order_discount" type="hidden"/>
                    <input name="in_shipping_cost"  class="in_shipping_cost" type="hidden"/>
                    <input name="in_grand_total"  class="in_grand_total" type="hidden"/>
                    <input name="in_paid_amount"  class="in_paid_amount" type="hidden"/>
                    <input name="in_single_subPrice"  class="in_single_subPrice" type="hidden"/>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">Return Note</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <table class="table table-bordered table-condensed totals ">
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
                    <button class="btn btn-primary" type="submit">Save</button>
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
        //get product
        function forSearchPur() {
            var proId = $('.all_product :selected').val();
            // alert(proId)
            $.ajax({
                url: "{{url('sale/get/single-product')}}/"+proId,
                method: 'get',
                success: function (data,id,dk) {
console.log(id);
                    ids.push(proId);
                    $('.all_product option:selected').remove();
                    $("#productTable").append(data);
                    totalPur();
                }
            })
        }



        //Delete product
        $("table.salereturn-list tbody").on("click", ".ibtnDel", function(event) {
            rowindex = $(this).closest('tr').index();
            $(this).closest("tr").remove();
            totalPur();
        });
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
        //calculate the total price on the purchase
        function totalPur() {
            var item = $('table.order-list tbody tr:last').index();
            item = ++item;
            $('#total_main_item').text(item);
            var total = 0;
            var total_quantity = 0;

            //Total Qty
            var total_qty = 0;
            $(".qty").each(function() {
                if ($(this).val() == '') {
                    total_qty += 0;
                } else {
                    total_qty += parseFloat($(this).val());
                }
            });
            total_quantity = total_quantity + total_qty;

            //Calculate Sub total
            var sub_total  = 0;

            $(".subtotal").each(function() {
                if ($(this).val() == '') {
                    sub_total += 0;
                } else {
                    sub_total += parseFloat($(this).val());
                }
            });

            //Sub total
            total = total + sub_total;
            $("#subtotal").text(parseFloat(total.toFixed(2)));
            var grandTotal = total;
            $("#total").text(parseFloat(total));
            $("#total-qty").text(parseFloat(total_quantity));
            $("#total_item").text(parseFloat(total_quantity));
            $("#grandtotalPrice").text(parseFloat(grandTotal));

            $(".in_item").val(parseFloat(item));
            $(".in_total_qty").val(parseFloat(total_quantity));
            $(".in_grand_total").val(parseFloat(grandTotal));
            $(".in_total_cost").val(parseFloat(sub_total));
        }

    </script>
@stop
