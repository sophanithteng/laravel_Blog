<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

        body {
            font-family: Raleway, sans-serif;
        }

        .content-wrapper {
            background-color: #f5f8fa;
        }
    </style>
    @stack('styles')
</head>

@auth
{{-- ==================== AUTHENTICATED: full AdminLTE sidebar layout ==================== --}}
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link">Visit site</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user mr-1"></i> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()) }}">
                        <i class="fas fa-id-badge mr-2"></i> Update profile
                    </a>
                    <a class="dropdown-item" href="{{ route('password.form') }}">
                        <i class="fas fa-key mr-2"></i> Change password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('home') }}" class="brand-link">
            <span class="brand-text font-weight-600 ml-3">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <i class="fas fa-user-circle fa-2x text-white ml-2"></i>
                </div>
                <div class="info ml-2">
                    <a href="{{ route('profile.edit', Auth::user()) }}" class="d-block text-white">
                        {{ Auth::user()->name }}
                    </a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('invoices.index') }}" class="nav-link {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>Invoices</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Cart</p>
                        </a>
                    </li>
                    <li class="nav-header">ACCOUNT</li>
                    <li class="nav-item">
                        <a href="{{ route('profile.edit', Auth::user()) }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-id-badge"></i>
                            <p>Update profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('password.form') }}" class="nav-link {{ request()->routeIs('password.form') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Change password</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content pb-4">
            @yield('content')
        </div>
    </div>

    <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}.</strong> All rights reserved.
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@stack('scripts')
</body>

@else
{{-- ==================== GUEST: simple top-nav layout (login/register) ==================== --}}
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <span class="brand-text font-weight-600">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="content pt-4 pb-4">
            @yield('content')
        </div>
    </div>

    <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}.</strong> All rights reserved.
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@stack('scripts')
</body>
@endauth

</html>
