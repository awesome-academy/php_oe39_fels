@extends('layouts.frontend_layout.master')
@section('content')
    
<div class="col-md-7">
    <form class="form-inline" action="{{ route('word-filter') }}" method="POST">@csrf
        <div class="form-group">
            <select name="course_id" class="form-select" aria-label="Default select example">
            <option value="all">@lang('user.all_course')</option>
            @foreach($listCategorys as $listCategory)
                <option value="{{$listCategory->id}}"> {{$listCategory->name}}</option>
            @endforeach
            </select>
            <hr>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="value" id="value1" value="all" checked>
            <label class="form-check-label" for="value1">
                @lang('user.all_word_list')
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="value" id="value2" value="learned">
            <label class="form-check-label" for="value2">
                @lang('user.word_learned')
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="value" id="value3" value="unlearned">
            <label class="form-check-label" for="value3">
                @lang('user.unlearned')
            </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('user.submit')</button>
    </form>
    <hr>
    <table class="table table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">@lang('user.word')</th>
        <th scope="col">@lang('user.course')</th>
        <th scope="col">@lang('user.status')</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach($words as $word)
        <tr>
        <th scope="row">{{ $i }}</th>
        <td>{{ $word->text }}</td>
        <td>{{ $word->course->name }}</td>
        @if(isLearned($word->id)=='learned')
            <td><span class="label label-success">@lang('user.word_learned')</span></td>
        @else
            <td><span class="label label-default">@lang('user.unlearned')</span></td>
        @endif
        </tr>
        <?php $i++; ?>
        @endforeach
    </tbody>
    </table>
</div>

@endsection
