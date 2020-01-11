<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{route('home')}}" class="waves-effect">
                        <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right">9+</span> <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> People <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('employee.index')}}">Employee</a></li>
                        <li><a href="{{route('supplier.index')}}">Suppliers</a></li>
                        <li><a href="{{route('customer.index')}}">Customer</a></li>


                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> People <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('salary.advanced.add')}}">Add Advanced Salary</a></li>
                        <li><a href="{{route('salary.advanced.all')}}">All Advanced Salary</a></li>
                        <li><a href="{{route('salary.pay')}}">Pay Salary</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('category.create')}}" class="waves-effect">
                        <i class="icon-accelerator"></i> Category </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
