@extends('layouts.home')

@section('title')
@lang('Note')
@endsection

@section('styles')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/summernote/summernote-bs4.css') }}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection

@section('page_header')
@lang('Note')
@endsection

@section('content')
<input id="store-route" class="hidden" value="{{ route('notes-store') }}">
<input id="show-route" class="hidden" value="{{ route('notes-show', ['id' => 'x']) }}">
<input id="update-route" class="hidden" value="">
<input id="delete-route" class="hidden" value="{{ route('notes-delete', ['id' => 'x']) }}">
<input id="csrf-token" class="hidden" value="{{ csrf_token() }}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools float-left">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-form">
                        @lang('Create')
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="note-list" class="row">
                    @foreach ($notes as $note)
                        <div class="col-md-3" id="note-{{ $note->id }}">
                            <div class="card" style="{{ $note->style }}">
                                <div class="card-header">
                                    <div class="card-tools float-right">
                                        <button id="edit-btn-{{ $note->id }}" class="btn btn-xs" data-toggle="modal" data-target="#edit-form">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button id="delete-btn-{{ $note->id }}" class="btn btn-xs">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ Str::limit($note->content, 15, '...') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="_create-form">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Create')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Content')</label>
                        <textarea class="form-control" name="content" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('Text')</label>
                        <div class="input-group _colorpicker">
                            <input type="text" class="form-control" name="color" value="#000000">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-square" style="color: #000000;"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('Background')</label>
                        <div class="input-group _colorpicker">
                            <input type="text" class="form-control" name="background-color" value="#FFFF99">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-square" style="color: #FFFF99;"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                    <button type="button" id="create-btn" class="btn btn-primary" data-dismiss="modal">@lang('Create')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="_edit-form">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Edit')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Content')</label>
                        <textarea class="form-control" name="content" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('Text')</label>
                        <div class="input-group _colorpicker">
                            <input type="text" class="form-control" name="color">
                            <div class="input-group-append">
                                <span class="input-group-text"><i id="sqr-color" class="fas fa-square"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('Background')</label>
                        <div class="input-group _colorpicker">
                            <input type="text" class="form-control" name="background-color">
                            <div class="input-group-append">
                                <span class="input-group-text"><i id="sqr-bg-color" class="fas fa-square"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                    <button type="button" id="edit-btn" class="btn btn-success" data-dismiss="modal">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Summernote -->
<script src="{{ asset('bower_components/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('bower_components/AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ mix('js/summernote.js') }}"></script>
<script src="{{ mix('js/colorpicker.js') }}"></script>
<script src="{{ mix('js/note_list.js') }}"></script>
@endsection
