@extends('layouts.frontend_layout.master')
@section('content')

    <div class="col-sm-8 col-md-7">
    <div class="thumbnail">
      @php
      $avatar = isset($userss->profile->avatar) ? $userss->profile->avatar : '';
      @endphp
      <img src="{{ asset('img/user/'.$avatar) }}" alt="user" class="profile-photo" />
      <div class="caption">
        <h3>{{ $user->name }}</h3>
        <span class="label label-info">300 @lang('user.word_learned')</span>
        <span class="label label-primary">{{$follower->count()}} @lang('user.followers')</span>
        <span class="label label-success">{{$following->count()}} @lang('user.followings')</span>
        <p>Email: {{ $user->email }}</p>
        <p>
        <a href="{{route('profile.edit',$user->id)}}" class="btn btn-primary" role="button">@lang('user.edit_profile')</a>
        @if($user->id != Auth::user()->id)
            @if(isFollowing($user->id)=='following')
            <a type="button" href="{{ route('unfollow',$user->id) }}" class="btn btn-default">@lang('user.unfollow')</a>
            @else
            <a type="button" href="{{ route('follow',$user->id) }}" class="btn btn-success">@lang('user.follow')</a>
            @endif
        @endif
        </p>
      </div>
      <p>@lang('user.course_progress'):</p>
      <div class="progress">
      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
        <span class="sr-only">40% @lang('user.complete')</span>
      </div>
    </div>
    </div>
  </div>

@endsection
