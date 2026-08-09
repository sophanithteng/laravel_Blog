@extends('auth.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Product::count() ?? 0 }}</h3>
                    <p>Products</p>
                </div>
                <div class="icon"><i class="fas fa-box"></i></div>
                <a href="{{ route('product.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Category::count() ?? 0 }}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon"><i class="fas fa-tags"></i></div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\Invoice::count() ?? 0 }}</h3>
                    <p>Invoices</p>
                </div>
                <div class="icon"><i class="fas fa-file-invoice-dollar"></i></div>
                <a href="{{ route('invoices.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\User::count() ?? 0 }}</h3>
                    <p>Users</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
                <span class="small-box-footer">&nbsp;</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-circle mr-2"></i>{{ __('Your Account') }}</h3>
                </div>
                <div class="card-body">
                    <p class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>You are logged in</p>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 140px;">User ID</th>
                            <td>{{ Auth::user()->id }}</td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td>{{ e(Auth::user()->name) }}</td>
                        </tr>
                        <tr>
                            <th>User Email</th>
                            <td>{{ e(Auth::user()->email) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-bolt mr-2"></i>{{ __('Quick Links') }}</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('profile.edit', Auth::user()) }}">
                                <i class="fas fa-id-badge mr-2"></i>Update profile
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('password.form') }}">
                                <i class="fas fa-key mr-2"></i>Change password
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('product.index') }}">
                                <i class="fas fa-box mr-2"></i>Manage products
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('categories.index') }}">
                                <i class="fas fa-tags mr-2"></i>Manage categories
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('invoices.index') }}">
                                <i class="fas fa-file-invoice-dollar mr-2"></i>View invoices
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
