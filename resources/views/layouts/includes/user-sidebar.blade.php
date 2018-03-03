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
                    <!-- <li>
                        <a href="/">News Feed</a>
                    </li> -->
                    <li>
                        <a href="/">Playlist</a>
                    </li>
                    <li>
                        <a href="/">Notes</a>
                    </li>
                    <!-- <li>
                        <a href="/">Posts</a>
                    </li>
                    <li>
                        <a href="/">Notes</a>
                    </li> -->
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

                    <li class="nav-divider"></li>

                    @if(isset($friends) && !is_null($friends))
                        @foreach($friends as $friend)
                        <li>
                            <a href="/user/{{ $friend->user->id }}" target="_blank">
                                @if(!is_null($friend->user->image_id))
                                <img src="/storage/user-profile-images/{{ $friend->user->image_id }}" class="img-circle" width="30px" height="30px"/>
                                @else
                                <img src="/storage/user-profile-images/user.png" class="img-circle" width="30px" height="30px"/>
                                @endif
                                <span class="user-sidebar-hashtag">{{ $friend->user->hashtag }}</span>
                            </a>
                        </li>
                        @endforeach
                    @endif

                    <!-- <li><a href="/"><i class="glyphicon glyphicon-off"></i> Sign in</a></li> -->

                </ul>
            </nav>
        </div>
@endif
