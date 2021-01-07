<nav class="topnav shadow navbar-light bg-white d-flex">
    <div class="navbar-brand"><a href="{{ route('home') }}">FELS ADMIN</a></div>
    <div class="nav-right ">
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 @lang('admin.notifications')</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">@lang('admin.all_notifications')</a>
              </div>
            </li>
          </ul>
        <div class="btn-group">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">@lang('admin.exit')</a>
            </div>
        </div>
    </div>

</nav>
