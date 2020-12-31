@extends('layouts.frontend_layout.master')
@section('content')

<div class="col-md-7 col-sm-6">
    <h4 class="grey">@lang('user.edit_profile')</h4>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    <form action="{{ route('profile.update',$profile->id) }}" class="contact-form" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>@lang('user.name')</label>
            <input id="contact-name" value="{{$profile->name}}" type="text" name="name" class="form-control" placeholder="@lang('messages.front_end.profile.enter_name')" required="required">
        </div>
        @error('name')
            {{ $message }}
        @enderror
        <div class="form-group">
            <label>@lang('user.email')</label>
            <input id="contact-email" value="{{$profile->email}}" type="text" name="email" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>@lang('user.gender')</label>
            <input type="radio" name="gender" id="male" value="1" @if ($profile->gender == 1)
            checked
            @endif><label for="">@lang('user.male')</label>
            <input type="radio" name="gender" id="female" value="0" @if ($profile->gender == 0)
            checked
            @endif><label for="">@lang('user.female')</label>
        </div>
        <div class="form-group">
            <label>@lang('user.avatar')</label>
            <input type="file" name="avatar-file">
        </div>
        <button type="submit" class="btn-primary">@lang('user.submit')</button>
    </form>
    <div class="changePass">
        <h1>@lang('user.change_pass')</h1>
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif
        <form action="{{ route('update-password') }}" class="contact-form" method="POST">
            @csrf
            <div class="form-group">
                <label>@lang('user.old_password')</label>
                <input type="password" id="old_password" name="old_password" class="form-control" >
            </div>
            @error('old_password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label>@lang('user.password')</label>
                <input type="password" name="password" class="form-control" >
            </div>
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label>@lang('user.confirm_pass')</label>
                <input type="password" id="confirm_password" name="password_confirmation" class="form-control" >
            </div>
            @error('password_confirmation')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn-primary">@lang('user.submit')</button>
        </form>
    </div>
</div>

@endsection
