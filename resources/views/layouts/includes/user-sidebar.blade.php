@if(@$sidebar != 'false')
        <div class="user-sidebar-parent">
            <nav class="nav-user-sidebar">

                @if(isset($user) && !is_null($user))
                    <a href="/user/{{ $user->id }}" target="_blank">
                        <div class="user-sidebar-image">
                            <img src="/storage/user-profile-images/{{ $user->image_id }}" class="user-image img-circle btn-upload-img pointer"/>
                            <span>{{ @$user->hashtag }}</span>
                        </div>
                    </a>
                @endif

                <ul class="nav">

                    <!-- <li class="nav-user-sidebar-active"> -->
                    <li class="nav-divider"></li>
                    <li>
                        <a href="/">News Feed</a>
                    </li>
                    <li>
                        <a href="/">Playlist</a>
                    </li>
                    <li>
                        <a href="/">Posts</a>
                    </li>
                    <li>
                        <a href="/">Notes</a>
                    </li>
                    <li class="nav-divider"></li>

                    @if(isset($user) && !is_null(@$user))
                        <li>
                            <a href="/user/follows/detail/{{ $user->id }}" target="_blank" class="pointer">
                            @lang('main.ifollow')
                            <span class="follow-count">{{ $user->friends->count() }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="/user/follows/detail/{{ $user->id }}" target="_blank" class="pointer">
                            @lang('main.followers')
                            <span class="follow-count">{{ $user->followers->count() }}</span>
                            </a>
                        </li>
                    @endif

                    <!-- <li><a href="/"><i class="glyphicon glyphicon-off"></i> Sign in</a></li> -->

                </ul>
            </nav>
        </div>
@endif
















<!-- @if(@$sidebar != 'false')
    @if(isset($user))
        <div class="user-sidebar-parent">
            <nav class="nav-user-sidebar">

                @if(!is_null($user))
                    <a href="/user/{{ $user->id }}" target="_blank">
                        <div class="user-sidebar-image">
                            <img src="/storage/user-profile-images/{{ $user->image_id }}" class="user-image img-circle btn-upload-img pointer"/>
                            <span>{{ @$user->hashtag }}</span>
                        </div>
                    </a>
                @endif

                <ul class="nav">
                    <li class="nav-user-sidebar-active">
                        <a href="/">Home</a>
                    </li>

                    <li class="nav-divider"></li>

                    @if(!is_null(@$user))
                        <li>
                            <a href="/user/follows/detail/{{ $user->id }}" target="_blank" class="pointer">
                            @lang('main.ifollow')
                            <span class="follow-count">{{ $user->friends->count() }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="/user/follows/detail/{{ $user->id }}" target="_blank" class="pointer">
                            @lang('main.followers')
                            <span class="follow-count">{{ $user->followers->count() }}</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-divider"></li>

                    <li><a href="javascript:;"><i class="glyphicon glyphicon-off"></i> Sign in</a></li>

                </ul>
            </nav>
        </div>
    @endif
@endif -->
