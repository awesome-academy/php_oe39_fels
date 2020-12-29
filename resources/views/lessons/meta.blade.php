<div class="lesson-meta card mb-3 shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="info col-9">
                <h5 class="lesson-name">
                    <a href="{{ route('lesson.detail', ['lesson' => $lesson]) }}" class="btn btn-outline-success">{{ $lesson->name }}</a>
                </h5>
            </div>
    
            <div class="action col-3 text-center">
                <a href="{{ route('lesson.detail', ['lesson' => $lesson]) }}" class="btn btn-danger">@lang('messages.front_end.profile.start_lesson')</a>
            </div>
        </div>
    </div>
</div>
