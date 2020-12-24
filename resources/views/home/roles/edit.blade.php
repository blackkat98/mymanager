@extends('layouts.home')

@section('title')
@lang('Role')
@endsection

@section('page_header')
@lang('Edit') {{ $role->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools float-right">
                    <a class="btn btn-sm btn-primary" href="{{ route('roles') }}">
                        @lang('Back to list')
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('roles-update', ['id' => $role->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label>
                            @lang('Name')*
                        </label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">@lang('Update')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
