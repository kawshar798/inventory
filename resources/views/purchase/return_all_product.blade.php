@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #cheque_number{
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title"><a  href="{{route('sale.return')}}" class="btn btn-primary m-3">Purchase  Return Product List</a></h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Date</th>
                            <th>Invoice No</th>
                            <th>Supplier</th>
                            <th>Grand Total</th>
                            <th>Total Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($products as $index=>$product)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{ date('d-m-Y', strtotime($product->created_at))}}</td>
                                <td>{{ $product->reference_no}}</td>
                                <td>{{ $product->supplier_id}}</td>
                                <td>{{ $product->grand_total}}</td>
                                <td>{{ $product->total_qty}}</td>
                                <td>
                                    <a href="{{url('purchase/return/sale-product/view',$product->id)}}" class="btn btn-primary">Show</a>
                                    <button  data-success_url="{{url('sale/return/product/list')}}"
                                             data-token="{{ csrf_token() }}"
                                             data-url="{{ url('return/sale-product/delete', $product->id) }}"
                                             data-id="{{ $product->id }}"
                                             class="btn btn-danger delete_sale_return_product"
                                             title="Delete">Delete</button>
                                    <a  href="{{url('return/sale-product/edit',$product->id)}}" title="Edit" class="btn btn-info">Edit</a>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        // Purchase delete Delete
        $(document).on('click', '.delete_sale_return_product', function(e) {
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
