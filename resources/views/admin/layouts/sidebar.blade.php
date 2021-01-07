<div id="sidebar" class="bg-white">
    <ul id="sidebar-menu">
        <li class="nav-link">
            <a href="?view=dashboard">
                <div class="nav-link-icon d-inline-flex">
                    <i class="far fa-folder"></i>
                </div>
                @lang('admin.dashboard')
            </a>
            <i class="arrow fas fa-angle-right"></i>
        </li>
        <li class="nav-link active">
            <a href="?view=list-product">
                <div class="nav-link-icon d-inline-flex">
                    <i class="far fa-folder"></i>
                </div>
                @lang('admin.course')
            </a>
            <i class="arrow fas fa-angle-down"></i>
            <ul class="sub-menu">
                <li><a href="{{ route('admin-course') }}">@lang('admin.course_list')</a></li>
            </ul>
        </li>
    </ul>
</div>
