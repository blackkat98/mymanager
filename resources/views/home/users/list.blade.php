@extends('layouts.home')

@section('title')
@lang('User')
@endsection

@section('page_header')
@lang('User')
@endsection

@section('content')
<input id="update-route" class="hidden" value="{{ route('users-update', ['id' => 'x']) }}">
<input id="delete-route" class="hidden" value="{{ route('users-delete', ['id' => 'x']) }}">
<input id="restore-route" class="hidden" value="{{ route('users-restore', ['id' => 'x']) }}">
<input id="csrf-token" class="hidden" value="{{ csrf_token() }}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools float-left">
                    <a class="btn btn-sm btn-primary" href="{{ route('users-create') }}">
                        @lang('Create')
                    </a>
                </div>
                <div class="card-tools">
                    
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('Full name')</th>
                            <th>@lang('Username')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Phone')</th>
                            <th>@lang('Address')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @if ($user->id == Auth::user()->id)
                                    <th>{{ $user->getFullName() }}</th>
                                    <th>{{ $user->username }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th>{{ $user->phone }}</th>
                                    <th>{{ $user->address }}</th>
                                @else
                                    <td>{{ $user->getFullName() }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                @endif
                                <td id="status-tag-{{ $user->id }}">
                                    @if ($user->deleted_at)
                                        <span class="badge bg-danger">Inactive</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->deleted_at)
                                        <button id="active-btn-{{ $user->id }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-play"></i>
                                        </button>
                                    @else
                                        <button id="inactive-btn-{{ $user->id }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-pause"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
@endsection

@section('scripts')
<script src="{{ mix('js/datatable.js') }}"></script>
<script src="{{ mix('js/user_datatable.js') }}"></script>
@endsection
