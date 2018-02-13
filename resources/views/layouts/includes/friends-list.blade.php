
@if(!is_null(@$friends))
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
@endif
