@extends('layouts.auth')

@section('title')
{{ _('Login') }}
@endsection

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">@lang('Login')</p>

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Email')" name="email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Password')" name="password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                    @lang('Remember Me')
                </label>
            </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">@lang('Login')</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <div class="social-auth-links text-center mb-3">
        <p>- @lang('OR') -</p>
        <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i>
            @lang('Sign in using Facebook')
        </a>
        <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i>
            @lang('Sign in using Google')
        </a>
    </div>
    <!-- /.social-auth-links -->

    <p class="mb-1">
        <a href="#">@lang('Forgot password')</a>
    </p>
    <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">@lang('Register')</a>
    </p>
</div>
<!-- /.login-card-body -->
@endsection
