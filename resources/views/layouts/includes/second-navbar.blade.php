<div class="second-navbar-parent">
    <nav class="navbar navbar-fixed-top second-navbar">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <!-- <li><a href="/">@lang('main.home')</a></li> -->
                <li><a class="pointer button-sidebar-show-friends">
                    @lang('main.ifollow')
                    <span class="follow-count">{{ $friends->count() }}</span>
                </a></li>

                <li><a class="pointer button-sidebar-show-friends">
                    @lang('main.followers')
                    <span class="follow-count">{{ $followers->count() }}</span>
                </a></li>
                <li><a class="pointer" id="button-sidebar-show-chits">@lang('main.chits')</a></li>
            </ul>
        </div>
    </nav>
</div>
