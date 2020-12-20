@extends('layouts.home')

@section('title')
@lang('User')
@endsection

@section('page_header')
@lang('Create')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('users-store') }}">
                    @csrf
                    <div class="form-group">
                        <label>
                            @lang('First name')*
                        </label>
                        <input class="form-control @error('first_name') is-invalid @enderror" name="first_name">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>
                            @lang('Middle name')
                        </label>
                        <input class="form-control" name="middle_name">
                    </div>
                    <div class="form-group">
                        <label>
                            @lang('Last name')*
                        </label>
                        <input class="form-control  @error('last_name') is-invalid @enderror" name="last_name">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>
                            @lang('Username')*
                        </label>
                        <input class="form-control @error('username') is-invalid @enderror" name="username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>
                            @lang('Email')*
                        </label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>
                            @lang('Password')*
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('Create')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
