@extends('layouts.frontend_layout.master')

@section('content')
    <div class="container">
        <div class="w-75 mx-auto">
            <h1>@lang('messages.front_end.profile.all_words_learn')</h1>
            <div class="item-list row">
                @foreach ($answers as $answer)
                    <div class="col-4">
                        <div class="card p-3">
                            <img src="{{ $answer->word->image_url }}" alt="">
                            <div class="card-body">
                                <p class="h4 text-center text-uppercase">{{ $answer->word->text }}</p>   
                            </div>
                            <div class="card-footer">
                                <p class="h4">{{ $answer->word->definition }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr>

            <div id="action" class="text text-center">
                <div id="action" class="text text-center">
                    @if ($lesson->is_complete)
                        <a href="{{ route('lesson.result.test', ['lesson' => $lesson]) }}" class="btn btn-success" >@lang('messages.front_end.profile.view_result')</a>
                    @else
                        <a href="{{ route('lesson.test', ['lesson' => $lesson]) }}" class="btn btn-danger">@lang('messages.front_end.profile.made_test')</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
