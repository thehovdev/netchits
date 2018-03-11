@if(@$sidebar != 'false')
        <div class="bot-sidebar-parent">
            <nav class="nav-bot-sidebar">
                <ul class="nav">
                    <li>
                        <a class="pointer peoples-label">Peoples</a>
                    </li>
                    <li class="nav-divider"></li>

                    @if(isset($peoples) && !is_null(@$peoples))
                        @foreach($peoples as $people)
                        <li>
                            <a href="/user/{{ $people->id }}" target="_blank">
                                @if(!is_null($people->image_id))
                                <img src="/storage/user-profile-images/{{ $people->image_id }}" class="img-circle" width="30px" height="30px"/>
                                @else
                                <img src="/storage/user-profile-images/user.png" class="img-circle" width="30px" height="30px"/>
                                @endif
                                <span class="user-sidebar-hashtag">{{ $people->hashtag }}</span>
                            </a>
                        </li>
                        @endforeach
                    @endif

                </ul>
            </nav>
        </div>
@endif
















<!-- @if(@$sidebar != 'false')
    @if(isset($user))
        <div class="bot-sidebar-parent">
            <nav class="nav-bot-sidebar">

                @if(!is_null($user))
                    <a href="/user/{{ $user->id }}" target="_blank">
                        <div class="bot-sidebar-image">
                            <img src="/storage/user-profile-images/{{ $user->image_id }}" class="user-image img-circle btn-upload-img pointer"/>
                            <span>{{ @$user->hashtag }}</span>
                        </div>
                    </a>
                @endif

                <ul class="nav">
                    <li class="nav-bot-sidebar-active">
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
