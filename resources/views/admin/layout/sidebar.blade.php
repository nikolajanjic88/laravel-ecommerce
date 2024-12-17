<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="{{ asset('admincss/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
        <h1 class="h5">{{ Auth::user()->name }}</h1>
    </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}"> <i class="icon-home"></i>
                Home
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.category') ? 'active' : '' }}">
            <a href="{{ route('admin.category') }}"><i class="icon-grid"></i>
                Categories
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.product') ? 'active' : '' }} {{ request()->routeIs('admin.createProduct') ? 'active' : '' }}">
        <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>
            Products
        </a>
        <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
            <li class="{{ request()->routeIs('admin.product') ? 'active' : '' }}">
                <a href="{{ route('admin.product') }}">View Products</a>
            </li>
            <li class="{{ request()->routeIs('admin.createProduct') ? 'active' : '' }}">
                <a href="{{ route('admin.createProduct') }}">
                    Add Product
                </a>
            </li>
        </ul>
        <li class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <a href="{{ route('admin.orders') }}"><i class="icon-grid"></i>Orders</a>
        </li>
    </ul>
</nav>
