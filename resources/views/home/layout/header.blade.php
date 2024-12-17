<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
        </button>
        <div class="collapse navbar-collapse p-3" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('products') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('products') }}">
                    Shop
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('cart') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cart') }}">Cart (<?= session('cart') ? count(session('cart')) : '0' ?>)</a>
                </li>
                <li class="nav-item {{ request()->routeIs('orders') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('orders') }}">My Orders</a>
                </li>
            </ul>
            <div class="user_option">
                @if (Route::has('login'))
                    @auth
                    @if (Auth::user()->usertype === 'admin')
                    <a href="{{ route('admin.index') }}">
                        <i class="fa fa-vcard" aria-hidden="true"></i>
                        <span>
                        Admin Panel
                        </span>
                    </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>
                        Login
                        </span>
                    </a>
                    <a href="{{ route('register') }}">
                        <i class="fa fa-vcard" aria-hidden="true"></i>
                        <span>
                        Register
                        </span>
                    </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
</header>
