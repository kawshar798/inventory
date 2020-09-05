@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('title','Expense')
@section('page_title','Expense')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{route('expense.index')}}">Expense Category</a>
    </li>
    <li class="breadcrumb-item active">
        Expense   Category
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
{{--                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-expense-category">Create Expense Category</a>--}}
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#showModal" id="create-new-expense-category">
                        Create Expense Category
                    </button>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses_Categories as $index=>$expense)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$expense->name}}</td>
                                <td>
                                    <button type="button"
                                            data-name="{{$expense->name}}"
                                            data-id="{{$expense->id}}"
                                            class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#showModal">
                                        Edit</i>
                                    </button>
                                    <button
                                        data-success_url="{{url('expense/category')}}"
                                        data-token="{{ csrf_token() }}"
                                        data-url="{{ url('expense/category/delete', $expense->id) }}"
                                        data-id="{{ $expense->id }}"
                                        class="btn btn-danger delete_brand"
                                              title="Delete">Delete</button>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- Create  Brand -->


            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- The Modal for Create -->
    <div class="modal" id="showModal">
        <div class="modal-dialog">
            <div class="modal-content">
                </tbody>
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitile"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="ajax-form-submit"   id="k" enctype="multipart/form-data" method="POST">
                    <input type="hidden" class="success_url" value="{{url('expense/category')}}">
                    <input type="hidden" class="submit_url" value="{{url('expense/category/store')}}">
                    <input type="hidden" class="method" value="POST">
                    <input type="hidden" class="id" name="id" value="">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input class="form-control name_modal"  type="text" placeholder="Expense Category Name" name="name">
                                <span id="msg"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger close_btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-save"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    //Create new expense category
    $('#create-new-expense-category').on('click',function (e) {
        e.preventDefault();
        $("#modalTitile").html("Create New Expense Category");
        $(".btn-save").html("New Expense Category");
        $("#showModal").show();
    });
    /*  When user click Edit user button */
    $('.edit-btn').on('click', function (e) {
        e.preventDefault();
        console.log('kk');
        var id        = $(this).data("id");
        var name    = $(this).data("name");
        $('.name_modal').val(name);
        $('.id').val(id);
        $('.k').trigger("reset");
        $('#modalTitile').html("Edit Category Expense");
        $('.btn-save').html("Update Category Expense");
        $("#showModal").show();
    });

    //Store Expense Category
    $(document).on('submit', '.ajax-form-submit', function(e) {
        e.preventDefault();
        var submit_url = $(this).attr("submit_url");
        var success_url = $(this).attr("success_url");
        var fd = new FormData(document.getElementById("k"));
        $.ajax({
            method: 'POST',
            url:"{{url('expense/category/store')}}",
            data:fd,
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.success == true) {
                    $('#addFees').modal('hide');
                    toastr.success(result.messege);
                    location.reload(success_url);
                } else {
                    toastr.error(result.messege);
                }
            },
        });
    });
    //  Expense Category
    $(document).on('click', '.delete_brand', function(e) {
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
