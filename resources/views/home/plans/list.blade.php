@extends('layouts.home')

@section('title')
@lang('Plan')
@endsection

@section('styles')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fullcalendar/main.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fullcalendar-daygrid/main.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fullcalendar-timegrid/main.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/fullcalendar-bootstrap/main.min.css') }}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('page_header')
@lang('Plan')
@endsection

@section('content')
<input id="store-route" class="hidden" value="{{ route('plans-store') }}">
<input id="get-route" class="hidden" value="{{ route('plans-get') }}">
<input id="show-route" class="hidden" value="{{ route('plans-show', ['id' => 'x']) }}">
<input id="update-route" class="hidden" value="{{ route('plans-update', ['id' => 'x']) }}">
<input id="delete-route" class="hidden" value="{{ route('plans-delete', ['id' => 'x']) }}">
<input id="csrf-token" class="hidden" value="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-4">
        <div class="sticky-top mb-3">
            <div class="card">
                <div class="card-header">
                    @lang('Create')
                    <div class="card-tools">
                        <button id="edit-btn" class="btn btn-sm btn-primary hidden" data-toggle="modal" data-target="#edit-form">
                            @lang('Edit')
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="create-form">
                        @csrf
                        <input class="hidden" name="color" value="#3c8dbc">
                        <div class="form-group">
                            <label>@lang('Color') <i id="color-sample" class="fas fa-circle" style="color: #3c8dbc"></i></label><br>
                            <div class="btn-group">
                                <ul class="fc-color-picker plan-create-color-picker">
                                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" name="name" placeholder="@lang('Name')">
                        </div>
                        <div class="form-group">
                            <label>@lang('Date time range')</label>
                            <input class="form-control datetimerange" name="datetimerange">
                        </div>
                        <button id="create-btn" class="btn btn-sm btn-primary">
                            @lang('Create')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-body p-0">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="_edit-form">
                @csrf
                <input class="hidden" id="plan-id">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Edit')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Color')</label>
                        <div class="input-group">
                            <input class="form-control" id="plan-color" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text" id="plan-color-sample">
                                    <span class="fas fa-square"></span>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group">
                            <ul class="fc-color-picker plan-edit-color-picker">
                                <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('Name')</label>
                        <input class="form-control" id="plan-name">
                    </div>
                    <div class="form-group">
                        <label>@lang('Date time range')</label>
                        <div class="input-group">
                            <input class="form-control datetimerange" id="plan-time">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="delete-btn" class="btn btn-danger" data-dismiss="modal">@lang('Delete')</button>
                    <button type="button" id="update-btn" class="btn btn-success" data-dismiss="modal">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('bower_components/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar-daygrid/main.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar-timegrid/main.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar-interaction/main.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/fullcalendar-bootstrap/main.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ mix('js/plan_list.js') }}"></script>
<script src="{{ mix('js/datetime.js') }}"></script>
@endsection
