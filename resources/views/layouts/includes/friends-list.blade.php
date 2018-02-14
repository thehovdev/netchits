@if(!is_null($friends))
<div class="col-sm-6">
    <div class="friends-parent">
        @if($permission == 'user')
            <a href="/user/follows/detail/{{ $user->id }}">@lang('main.ifollow')</a>
        @else
            <a href="/user/follows/detail/{{ $userprofile->id }}">@lang('main.ifollow')</a>
        @endif

    </div>
    @foreach($friends as $friend)
    <div class="friend-item">
        <a class="pointer" href="/user/{{ $friend->user->id }}" target="_blank">
            <div class="user-image">
                @if(!is_null($friend->user->image_id))
                    <img src="/storage/user-profile-images/{{ $friend->user->image_id }}" class="img-circle" width="80px" height="80px"/>
                @else
                    <img src="/storage/user-profile-images/user.png" class="img-circle" width="80px" height="80px"/>
                @endif
            </div>
            <div class="user-hashtag">
                    {{ $friend->user->hashtag }}
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif

@if(!is_null($followers))
<div class="col-sm-6">
    <div class="followers-parent">
        @if($permission == 'user')
            <a href="/user/follows/detail/{{ $user->id }}">@lang('main.followers')</a>
        @else
            <a href="/user/follows/detail/{{ $userprofile->id }}">@lang('main.followers')</a>
        @endif

    </div>
    @foreach($followers as $follower)
        <div class="friend-item">
            <a class="pointer" href="/user/{{ $follower->follower->id }}" target="_blank">
                <div class="user-image">
                    @if(!is_null($follower->follower->image_id))
                        <img src="/storage/user-profile-images/{{ $follower->follower->image_id }}" class="img-circle" width="80px" height="80px"/>
                    @else
                        <img src="/storage/user-profile-images/user.png" class="img-circle" width="80px" height="80px"/>
                    @endif
                </div>
                <div class="user-hashtag">
                        {{ $follower->follower->hashtag }}
                </div>
            </a>
        </div>

    @endforeach
</div>
@endif
