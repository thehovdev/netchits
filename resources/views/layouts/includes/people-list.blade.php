<div class="people-parent">@lang('main.peoples')</div>


@if(!is_null(@$peoples))
    @foreach($peoples as $people)
    <div class="people-item">
        <a class="pointer" href="/user/{{ $people->id }}" target="_blank">
            <div class="user-image">
                @if(!is_null($people->image_id))
                    <img src="/storage/user-profile-images/{{ $people->image_id }}" class="img-circle" width="60px" height="60px"/>
                @else
                    <img src="/storage/user-profile-images/user.png" class="img-circle" width="60px" height="60px"/>
                @endif
            </div>
            <div class="user-hashtag">
                    {{ $people->hashtag }}
            </div>
        </a>
    </div>
    @endforeach
@endif



{{--
    <div class="people-item">
        <a class="pointer" href="/user/1" target="_blank">
            <div class="user-image">
                    <img src="/storage/user-profile-images/user.png" class="img-circle" width="60px" height="60px"/>
            </div>
            <div class="user-hashtag">
                    #friend
            </div>
        </a>
    </div>
--}}
