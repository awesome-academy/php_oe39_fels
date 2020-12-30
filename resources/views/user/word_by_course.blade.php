@extends('layouts.frontend_layout.master')

@section('content')
    <div class="container">
        <div class="w-75 mx-auto">
            <h1>{{ $course->name }}</h1>
            <div class="item-list row">
                @foreach ($words as $word)
                    <div class="col-4">
                        <div class="card p-3">
                            <img src="{{ $word->image_url }}" alt="">
                            <div class="card-body">
                                <p class="h4 text-center text-uppercase">{{ $word->text }}</p>   
                            </div>
                            <div class="card-footer">
                                <p class="h4">{{ $word->definition }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
            {{ $words->links() }}
        </div>
    </div>
@endsection
