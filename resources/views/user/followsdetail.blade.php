@extends('start.init')

@section('content')

@include('layouts.includes.navbar')


<div class="bar search-progress-bar" style="visibility:hidden;">
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width: 100%">
        </div>
    </div>
</div>


<div class="margin-top80"></div>

<div class="row search-result-row" style="display:none;">
    <div class="col-sm-12 search-result-col">
        <div class="search-result-parent">
            <a class="search-user-href" href="#">
                <img src="/storage/user-profile-images/" class="search-user-image img-circle"/>
            </a>
         <button class="btn btn-primary button-add-friend" data-option="main">
                <span class="search-follow-text">
                    @lang('main.follow')
                </span>

                <span class="search-followed-text">
                    @lang('main.followed')
                </span>
                <span class="search-user-hashtag" id="search-user-hashtag">#user</span>
        </button>
        </div>
    </div>
</div>


<div class="row row-friends"
    data-load="0">
    <div class="col-sm-12">
        <div class="friends-list">

            @if(!is_null($friends))
            <div class="col-sm-6">
                <div class="friends-parent">
                    <a href="/user/follows/detail/{{ $userprofile->id }}">@lang('main.ifollow')</a>
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
                    <a href="/user/follows/detail/{{ $userprofile->id }}">@lang('main.followers')</a>
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



        </div>
    </div>
</div>


@endsection
