<nav class="navbar navbar-default navbar-fixed-top menu">
  <div class="container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/home"><p>OE39 FELS</p></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right main-menu">
        <li class="dropdown"><a href="{{ route('list-all-word') }}">@lang('user.all_word_list')</a></li>
        <li class="dropdown"><a href="contact.html">@lang('user.all_course')</a></li>
        <li class="dropdown"><a href="{{ route('activity') }}">@lang('user.activity')</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle pages" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('user.language') <span><img src="images/down-arrow.png" alt="" /></span></a>
          <ul class="dropdown-menu page-list">
            <li><a class="dropdown-item" href="{!! route('change-language', ['en']) !!}">@lang('user.english')</a></li>
            <li><a class="dropdown-item" href="{!! route('change-language', ['vi']) !!}">@lang('user.vietname')</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="" id="btn_logout">@lang('user.logout')</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
>>>>>>> words filter update filter by word status and activity user log
</nav>
