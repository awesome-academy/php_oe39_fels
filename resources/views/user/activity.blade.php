@extends('layouts.frontend_layout.master')
@section('content')
    
<div class="col-md-7">
    <p>@lang('user.activity')</p>
    <table class="table table-striped table-hover">
    <tbody>
        <?php $i = 1; ?>
        @foreach($activities as $activity)
        <tr>
        <th scope="row">{{ $i }}</th>
        <td>You {{ $activity->acvity_type }}
            @if(isTypeActivity($activity->acvity_type)=='user')
            <a href="">{{DB::table('users')->where('id',$activity->descrition)->first()->name}}</a> 
            @endif
        </td>
        <td>{{ $activity->created_at }}</td>
        </tr>
        <?php $i++; ?>
        @endforeach
    </tbody>
    </table>
</div>

@endsection
