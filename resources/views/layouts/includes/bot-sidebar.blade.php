@if(@$sidebar != 'false')
        <div class="bot-sidebar-parent">
            <nav class="nav-bot-sidebar">
                <ul class="nav">
                    <li>
                        <a href="/">@Marty</a>
                    </li>
                    <li class="nav-divider"></li>
                    <li>
                        <a href="/">Action1</a>
                    </li>
                    <li>
                        <a href="/">Action2</a>
                    </li>
                    <li>
                        <a href="/">Action3</a>
                    </li>
                    <li class="nav-divider"></li>
                    <li>
                        <a href="/">Notifications</a>
                    </li>
                    <li class="nav-divider"></li>


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
