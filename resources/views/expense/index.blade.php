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
        <a href="{{route('expense.index')}}">Expense</a>
    </li>
    <li class="breadcrumb-item active">
        Expense   List
    </li>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#showModal" id="create-new-expense">
                        Expense Create
                    </button>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Details</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Month</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $index=>$expense)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$expense->details}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{$expense->date}}</td>
                                <td>{{$expense->month}}</td>
                                <td>
                                    <button type="button"
                                            data-amount="{{$expense->amount}}"
                                            data-note="{{$expense->note}}"
                                            data-id="{{$expense->id}}"
                                            data-expense_category="{{$expense->expense_category}}"
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
                            <!-- Edit  Brand -->
                        @endforeach
                        </tbody>
                    </table>

                </div>



            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
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
                    <input type="hidden" class="submit_url" value="{{url('expense/store')}}">
                    <input type="hidden" class="method" value="POST">
                    <input type="hidden" class="id" name="id" value="">
                @csrf
                    <input type="hidden" name="date" value="{{date("d/m/y")}}">
                    <input type="hidden" name="month" value="{{date("F")}}">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Expense Category</label>
                            <div class="col-sm-9">
                                <span id="msg"></span>
                                <select name="expense_category" class="form-control model_expense_category">
                                    <option value="">Select One</option>
                                    @foreach($expense_categories as $expenseCat)
                                        <option value={{$expenseCat->id}}>{{$expenseCat->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Expense Amount</label>
                            <div class="col-sm-9">
                                <input class="form-control modal_amount"  type="number" placeholder="Expense  Amount" name="amount">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <textarea name="note" class="form-control note_modal"></textarea>
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
    $('#create-new-expense').on('click',function (e) {
        e.preventDefault();
        $("#modalTitile").html("Create New Expense ");
        $(".btn-save").html("New Expense");
        $("#showModal").show();
    });

    //Store Expense
    $(document).on('submit', '.ajax-form-submit', function(e) {
        e.preventDefault();
        var submit_url = $(this).attr("submit_url");
        var success_url = $(this).attr("success_url");
        var fd = new FormData(document.getElementById("k"));
        $.ajax({
            method: 'POST',
            url:"{{url('expense/store')}}",
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

    /*  When user click Edit user button */
    $('.edit-btn').on('click', function (e) {
        e.preventDefault();
        console.log('kk');
        var id        = $(this).data("id");
        var amount    = $(this).data("amount");
        var note      = $(this).data("note");
        var expense_category    = $(this).data("expense_category");
        $('.model_expense_category').val(expense_category);
        $('.note_modal').val(note);
        $('.modal_amount').val(amount);
        $('.id').val(id);
        $('.k').trigger("reset");
        $('#modalTitile').html("Edit Category Expense");
        $('.btn-save').html("Update Category Expense");
        $("#showModal").show();
    });

</script>

@stop
