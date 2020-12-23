@extends('layouts.frontend_layout.master')
@section('content')
    
<div class="col-md-7">
    <form class="form-inline" action="{{ route('word-filter') }}" method="POST">@csrf
        <div class="form-group">
            <select name="course_id" class="form-select" aria-label="Default select example">
            <option value="all" @if($course_selected == 'all') selected @endif>@lang('user.course')</option>
            @foreach($listCategorys as $listCategory)
                <option value="{{$listCategory->id}}" @if($course_selected==$listCategory->id) selected @endif> {{$listCategory->name}}</option>
            @endforeach
            </select>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="value" id="value1" value="all" @if($valueChoose == 'all') checked @endif>
            <label class="form-check-label" for="value1">
                @lang('user.all_word_list')
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="value" id="value2" value="learned" @if($valueChoose == 'learned') checked @endif>
            <label class="form-check-label" for="value2">
                @lang('user.word_learned')
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="value" id="value3" value="unlearned" @if($valueChoose == 'unlearned') checked @endif>
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
        @if($valueChoose == 'all')
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
        @elseif($valueChoose == 'learned')
            @foreach($words as $word)
                @if(isLearned($word->id)=='learned')
                <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $word->text }}</td>
                <td>{{ $word->course->name }}</td>
                <td><span class="label label-success">@lang('user.word_learned')</span></td>
                </tr>
                <?php $i++; ?>
                @endif
            @endforeach 
        @elseif($valueChoose == 'unlearned') 
            @foreach($words as $word)
                @if(isLearned($word->id)=='unlearned')
                <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $word->text }}</td>
                <td>{{ $word->course->name }}</td>
                <td><span class="label label-default">@lang('user.unlearned')</span></td>
                </tr>
                <?php $i++; ?>
                @endif
            @endforeach         
        @endif
    </tbody>
    </table>
</div>

@endsection
