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
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fas fa-cubes"></i><span> Product <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('category.index')}}">Category</a></li>
                        <li><a href="{{route('brand.index')}}">Brand</a></li>
                        <li><a href="{{route('product.index')}}">Product List</a></li>
                        <li><a href="{{route('product.create')}}">Product Add</a></li>
{{--                        <li><a href="{{route('product.print-barcode')}}">Print Barcode</a></li>--}}

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-money-bill"></i><span> Purchase <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('purchase.index')}}">Purchase List</a></li>
                        <li><a href="{{route('purchase.create')}}">Purchase Add</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-shopping-cart"></i><span> Sale <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('pos.create')}}">Pos</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="far fa-money-bill-alt"></i><span> Expense <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('expense.index')}}">Expense List</a></li>
                        <li><a href="{{route('expense.category.index')}}">Expense Category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> Return <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('expense.index')}}">Sale</a></li>
                        <li><a href="{{route('expense.index')}}">Purchase </a></li>
                    </ul>
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
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> HRM <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('salary.advanced.add')}}">Add Advanced Salary</a></li>
                        <li><a href="{{route('salary.advanced.all')}}">All Advanced Salary</a></li>
                        <li><a href="{{route('salary.pay')}}">Pay Salary</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> Setting <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('setting.tax.index')}}">Tax Rate</a></li>
                        <li>
                            <a href="{{route('unit.index')}}" class="waves-effect">Unit</a>
                        </li>


                    </ul>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
