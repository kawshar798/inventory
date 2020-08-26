
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Stexo - Responsive Admin & Dashboard Template | Themesdesign</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">

    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet" type="text/css">

</head>

<body>

<!-- Begin page -->
<div class="accountbg"></div>
<div class="home-btn d-none d-sm-block">
    <a href="{{url('/')}}" class="text-white"><i class="fas fa-home h2"></i></a>
</div>
<div class="wrapper-page">
    <div class="card card-pages shadow-none">
@yield('content')
    </div>
</div>
<!-- END wrapper -->

<!-- jQuery  -->
<script src="{{asset('/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/js/metismenu.min.js')}}"></script>
<script src="{{asset('/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('/assets/js/waves.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('/assets/js/app.js')}}"></script>

</body>

</html>
