@extends('Auth.layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h4 class="mb-0"><i class="fas fa-sign-in-alt mr-2"></i>Login</h4>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    @if(Session::has('errors'))
                        <div class="alert alert-danger">{!! $errors->first() !!}</div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="email_address">E-Mail Address</label>
                            <div class="input-group">
                                <input type="text" id="email_address" class="form-control" name="email"
                                       value="{{ old('email') }}" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control" name="password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" value="1">
                                <label for="remember" class="mb-0 ml-1">Remember Me</label>
                            </div>
                            <a href="{{ route('forget.password.get') }}">Reset Password</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
