@extends('Auth.layout')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h4 class="mb-0"><i class="fas fa-user-plus mr-2"></i>Register</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-user"></span></div>
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email_address">E-Mail Address</label>
                            <div class="input-group">
                                <input type="email" id="email_address" class="form-control" name="email" value="{{ old('email') }}" required>
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

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                </div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Register
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
