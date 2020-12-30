@extends('layouts.frontend_layout.master')
@section('content')
    
<div class="container">
    <div class="title my-4">
        <h2>@lang('messages.front_end.profile.title_test'){{ $lessons->name }}</h2>
    </div>
    <div class="questions my-2">
        <form action="{{ route('lesson.handle.test', ['lesson' => $lesson]) }}" method="POST">
            @csrf

            @foreach ($questions as $key => $question)
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                       <p class="h4">{{ $key + 1 }} : {{ $question->name }}</p> 
                    </div>

                    <div class="card-body">
                        <div class="form-check">
                            <input type="hidden" name="{{ $question->id }}">
                        </div>
                        @foreach ($question->answers as $key => $answer)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $question->id }}" id="question-{{ $question->id }}{{ $key }}" value="{{ $answer->id }}">
                                <label class="form-check-label ml-5" for="question-{{ $question->id }}{{ $key }}">{{ $answer->word->text }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <input type="submit" value="Submit" class="btn btn-danger">
        </form>
    </div>
</div>

@endsection
