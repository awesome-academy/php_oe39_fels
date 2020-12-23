@extends('layouts.frontend_layout.master')
@section('content')
    
<div class="col-md-7">
   <div class="panel-body">
        <div class="col-md-6 static">
            <div class="suggestions" id="sticky-sidebar">
                <h4 class="grey">@lang('user.all_user')</h4>
                @foreach ($users as $user)
                    <div class="follow-user">
                        <img src="{{ asset('img/user/user-1.jpg') }}" alt="" class="profile-photo-sm pull-left" />
                        <div>
                        <h5><a href="">{{ $user->name }}</a></h5>
                        <p>Email: {{ $user->email }}</p>
                        <p>123 @lang('user.word_learned')</p>
                        @if($user->id != Auth::user()->id)
                            @if(isFollowing($user->id)=='following')
                            <a type="button" href="{{ route('unfollow',$user->id) }}" class="btn btn-default">@lang('user.unfollow')</a>
                            @else
                            <a type="button" href="{{ route('follow',$user->id) }}" class="btn btn-success">@lang('user.follow')</a>
                            @endif
                        @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>     
    </div>
</div>

@endsection
