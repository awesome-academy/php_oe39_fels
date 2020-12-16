<div class="col-md-3 static">
    <div class="profile-card">
        <img src="{{ asset('img/user/user-1.jpg') }}" alt="user" class="profile-photo" />
        <h5><a href="timeline.html" class="text-white">{{ Auth::user()->name }}</a></h5>
        <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> {{ $follower->count() }} @lang('user.followers')</a>
    </div><!--profile card ends-->
    <ul class="nav-news-feed">
        <li><i class="icon ion-ios-people-outline"></i><div><a href="newsfeed-friends.html">{{ $following->count() }} @lang('user.followings')</a></div></li>
        <li><i class="icon ion-chatboxes"></i><div><a href="newsfeed-messages.html">1000 @lang('user.word_learned')</a></div></li>
    <li><i class="icon ion-chatboxes"></i><div><a href="{{ route('user.profile', Auth::user()->id) }}">@lang('user.profiles')</a></div></li>
    </ul><!--news-feed links ends-->
    <div id="chat-block">
        <div class="title">@lang('user.course_started')</div>
        <ul class="online-users list-inline">
            <li><a href="newsfeed-messages.html" title="Linda Lohan"><img src="{{ asset('img/course/8.jpg') }}" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
            <li><a href="newsfeed-messages.html" title="Sophia Lee"><img src="{{ asset('img/course/8.jpg') }}" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
            <li><a href="newsfeed-messages.html" title="John Doe"><img src="{{ asset('img/course/8.jpg') }}" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
        </ul>
    </div><!--chat block ends-->
</div>
