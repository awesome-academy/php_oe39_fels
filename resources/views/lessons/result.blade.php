@extends('layouts.frontend_layout.master')
    @section('content')
        <div class="container">
            <div class="title my-4">
                <div class="title my-4">
                    <h2>{{ $lesson->name }}</h2>
                    <h2>{{ $score }}/{{ $total }}</h2>
                </div>
            </div>
            <div class="questions my-2">
                @foreach ($questions as $key => $question)
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            {{ $key + 1 }}: {{ $question->name }}
                        </div>
                            
                        <div class="card-body">
                            <div class="form-check">
                                <input type="hidden" name="{{ $question->id }}">
                            </div>
                            @foreach ($question->answers as $answer)
                                <div class="form-check">
                                    @if ($answer->is_correct)
                                        <input class="form-check-input" type="radio"
                                        name="{{ $question->id }}" value="{{ $answer->id }}"
                                        {{ isset($history[$question->id]) && $history[$question->id] == $answer->id ? 'checked' : '' }}
                                        disabled>
                                        <label class="form-check-label ml-5 {{ isset($history[$question->id]) && $history[$question->id] == $answer->id ? 'text-success' : 'text-danger' }}" for="question-{{ $question->id }}">{{ $answer->word->text }}</label>
                                    @else
                                        <input class="form-check-input" type="radio"
                                            name="{{ $question->id }}" value="{{ $answer->id }}"
                                            {{ isset($history[$question->id]) && $history[$question->id] == $answer->id ? 'checked' : '' }}
                                            disabled>
                                            <label class="form-check-label ml-5">{{ $answer->word->text }}</label>
                                    @endif
                            
                                 </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="action d-flex flex-column flex-md-row">
                <a href="{{ route('lesson.detail', ['lesson' => $lesson]) }}" class="btn btn-primary mx-4">@lang('messages.front_end.profile.back_lesson')</a>
            </div>
        </div>
@endsection
