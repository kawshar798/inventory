@extends('layouts.app')
@push('head_styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-8 offset-2">
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
    </div> <!-- end row -->


@endsection
@section('footerScripts')
    @parent

@stop
