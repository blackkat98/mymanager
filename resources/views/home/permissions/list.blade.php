@extends('layouts.home')

@section('title')
@lang('Permission')
@endsection

@section('page_header')
@lang('Permission')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools float-left">
                    <a class="btn btn-sm btn-primary" href="{{ route('permissions-create') }}">
                        @lang('Create')
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Created at')</th>
                            <th>@lang('Updated at')</th>
                            <th>@lang('Number of roles')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
                                <td>{{ $permission->roles->count() }}</td>
                                <td>
                                    <div class="row">
                                        <a class="btn btn-success" href="{{ route('permissions-edit', ['id' => $permission->id]) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#delete-form-{{ $permission->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="delete-form-{{ $permission->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" action="{{ route('permissions-delete', ['id' => $permission->id]) }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('Delete') {{ $permission->name }}?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                               
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                                                <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
<script src="{{ mix('js/toasts.js') }}"></script>
@endsection
