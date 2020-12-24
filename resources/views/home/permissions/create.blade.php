@extends('layouts.home')

@section('title')
@lang('Permission')
@endsection

@section('page_header')
@lang('Create')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools float-right">
                    <a class="btn btn-sm btn-primary" href="{{ route('permissions') }}">
                        @lang('Back to list')
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('permissions-store') }}">
                    @csrf
                    <div class="form-group">
                        <label>
                            @lang('Name')*
                        </label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name">
                        @error('name')
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
