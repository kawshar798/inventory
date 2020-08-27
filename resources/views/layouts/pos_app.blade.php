
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Inventory</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/plugins/morris/morris.css">

    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    @stack('head_styles')

</head>

<body>
<!-- Begin page -->
{{--<div id="wrapper" style="background: #f7f6f9;padding: 20px 0px">--}}
<div id="wrapper">
    <div class="container-fluid">
        @yield('content')
    </div>

    @include('layouts.partials.footer')
</div>
<!-- END wrapper -->


@section('footerScripts')
    <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/metismenu.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/waves.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>

    <script src="{{asset('assets/pages/dashboard.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    {!! Toastr::message() !!}
@show


</body>

</html>
