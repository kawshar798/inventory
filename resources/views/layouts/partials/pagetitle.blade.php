<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">@yield('page_title')</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Inventory</a></li>
                @section('breadcrumb')

                @show
            </ol>
        </div>
    </div>
    <!-- end row -->
</div>
