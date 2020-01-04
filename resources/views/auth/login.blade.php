
@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="text-center m-t-0 m-b-15">
            <a href="index.html" class="logo logo-admin"><img src="{{asset('/assets/images/logo-dark.png')}}" alt="" height="24"></a>
        </div>
        <h5 class="font-18 text-center">Sign in to continue to Stexo.</h5>


        <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}">

            <div class="form-group">
                <div class="col-12">
                    <label>Username</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-12">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-12">
                    <div class="checkbox checkbox-primary">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1"> Remember me</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group text-center m-t-20">
                <div class="col-12">
                    <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                </div>
            </div>

            <div class="form-group row m-t-30 m-b-0">
                <div class="col-sm-7">
{{--                    <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>--}}
                    @if (Route::has('password.request'))
                        <a class="text-muted" href="{{ route('password.request') }}">
                            <i class="fa fa-lock m-r-5"></i>  {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
{{--                <div class="col-sm-5 text-right">--}}
{{--                    <a href="pages-register.html" class="text-muted">Create an account</a>--}}
{{--                </div>--}}
            </div>
        </form>
    </div>
@endsection

