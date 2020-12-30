@extends('layouts.frontend_layout.master')
@section('content')

 @include('layouts.frontend_layout.sidebar')

<div class="col-md-7">
    <!-- Post Content
    ================================================= -->
    <div class="course-list row">
        <h1>@lang('messages.front_end.profile.course_enroll')</h1>
        
        @foreach ($courseEnrolled as $course)
            <div class="col-6">
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="info col-12 col-md-10">
                                <h4 class="course-name">
                                    {{ $course->name }}
                                </h4>                              
                                <p>
                                    @if ($course->isEnrolled)
                                    <span class="badge badge-info">
                                        @lang('messages.front_end.profile.enrolled')
                                    </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('course.detail', ['course' => $course]) }}" class="btn btn-primary">@lang('messages.front_end.profile.detail_course')</a>
                    </div>
                </div>                
            </div>
        @endforeach
    </div>
    <hr>
    @foreach ($courses as $course)
    @php
        $countLesson = $lesson->where('course_id',$course->id)->count();
    @endphp
    <div class="post-content">
        <img src="{{ asset('img/course/8.jpg') }}" alt="post-image" class="img-responsive post-image" />
        <div class="post-container">
            <div class="post-detail">
            <div class="user-info">
                <h5><a href="{{ route('course.detail', $course->id) }}" class="profile-link">{{ $course->name }}</a> <span class="following">{{ $countLesson }} @lang('user.lesson')</span></h5>
            </div>
            <div class="reaction">
                <a href="{{ route('course.detail', $course->id) }}" class="btn btn-success">@lang('user.open_sourse')</a>
                <a href="{{ route('course.words', ['course' => $course]) }}" class="btn btn-info"> @lang('user.all_word_list')</a>
            </div>
            <div class="line-divider"></div>
            <div class="post-text">
                <p>{{ $course->description }}</p>
            </div>
            <div class="line-divider"></div>
            </div>
        </div>
    </div>     
    @endforeach
</div>

@include('layouts.frontend_layout.top_user')

@endsection
