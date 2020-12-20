@extends('layouts.home')

@section('title')
{{ __('Me') }}
@endsection

@section('page_header')
{{ __('Me') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <form id="avatar-form" method="post" action="{{ route('me-update-avatar') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="avatar">
                            <img for="avatar" class="profile-user-img img-circle img-fluid" src="{{ asset(Auth::user()->avatar->path) }}" alt="User">
                        </label>
                        <input type="file" class="hidden" id="avatar" name="avatar">
                    </form>
                </div>
                <h3 class="profile-username text-center">{{ Auth::user()->getFullName() }}</h3>
                <p class="text-muted text-center">Software Engineer</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{ __('Phone') }}</b><br>{{ Auth::user()->phone }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('Email') }}</b><br>{{ Auth::user()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('Address') }}</b><br>{{ Auth::user()->address }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('Language') }}</b><br>{{ Auth::user()->lang }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#edit" data-toggle="tab">{{ __('Edit') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pwd" data-toggle="tab">{{ __('Change password') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">{{ __('Activity') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">{{ __('Settings') }}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="edit">
                        <form method="post" action="{{ route('me-update-info') }}">
                            @csrf
                            <input class="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label>{{ __('First name') }}</label>
                                <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ Auth::user()->first_name }}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Middle name') }}</label>
                                <input class="form-control" name="middle_name" value="{{ Auth::user()->middle_name }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Last name') }}</label>
                                <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ Auth::user()->last_name }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Username') }}</label>
                                <input class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Auth::user()->username }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Phone') }}</label>
                                <input class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Address') }}</label>
                                <textarea class="form-control" name="address">{{ Auth::user()->address }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="pwd">
                        <form method="post" action="{{ route('me-update-password') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('Old password') }}</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password">
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('New password') }}</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password">
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Confirm new password') }}</label>
                                <input type="password" class="form-control" name="new_password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="activity">
                        
                    </div>
                    <div class="tab-pane" id="settings">
                        <form method="post" action="{{ route('me-update-lang') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('Name Format') }}</label>
                                <select class="form-control" name="is_first_name_first">
                                    <option value="1" {{ Auth::user()->is_first_name_first == 1 ? 'selected' : '' }}>{{ __('First name first') }}</option>
                                    <option value="0" {{ Auth::user()->is_first_name_first == 0 ? 'selected' : '' }}>{{ __('Last name first') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Language') }}</label>
                                <select class="form-control" name="lang">
                                    <option value="en" {{ Auth::user()->lang == 'en' ? 'selected' : '' }}>{{ __('English') }}</option>
                                    <option value="vi" {{ Auth::user()->lang == 'vi' ? 'selected' : '' }}>{{ __('Vietnamese') }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
</div>
@endsection

@section('scripts')
<script src="{{ mix('js/avatar.js') }}"></script>
@endsection
