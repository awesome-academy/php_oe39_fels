@extends('admin.layouts.master')

@section('title', 'Course')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">@lang('admin.course_list')</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">@lang('admin.image')
                        </th>
                        <th scope="col">@lang('admin.course_name')</th>
                        <th scope="col">@lang('admin.create_at')</th>
                        <th scope="col">@lang('admin.status')</th>
                        <th scope="col">@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>1</td>
                        <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                        <td><a href="#">Samsung Galaxy A51 (8GB/128GB)</a></td>
                        <td>26:06:2020 14:00</td>
                        <td><span class="badge badge-success">Còn hàng</span></td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
