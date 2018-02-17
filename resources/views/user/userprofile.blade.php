@extends('start.init')

@section('content')
<!-- Main navbar -->
@include('layouts.includes.navbar')

@if($user->permission != 'guest')
    <input type="hidden" id="hiddentitle" value="Netchits {{ $user->hashtag }} profile"></input>
@else
    <input type="hidden" id="hiddentitle" value="Netchits {{ $userprofile->hashtag }} profile"></input>
@endif
<!--Second Navbar-->
<div class="second-navbar-parent">
    <nav class="navbar navbar-fixed-top second-navbar">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <!-- <li><a href="/">@lang('main.home')</a></li> -->
                <li><a href="/user/follows/detail/{{ $user->id }}" class="pointer button-sidebar-show-friends">
                    @lang('main.ifollow')
                    <span class="follow-count">{{ $friends->count() }}</span>
                </a></li>

                <li><a href="/user/follows/detail/{{ $user->id }}" class="pointer button-sidebar-show-friends">
                    @lang('main.followers')
                    <span class="follow-count">{{ $followers->count() }}</span>
                </a></li>
                <li><a href="/" class="pointer" id="button-sidebar-show-chits">@lang('main.chits')</a></li>
            </ul>
        </div>
    </nav>
</div>

<!--Progress Bar-->
<div class="bar search-progress-bar" style="visibility:hidden;">
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width: 100%">
        </div>
    </div>
</div>
<div class="container">
    <div class="margin-top100"></div>
    @if($user->permission != 'guest')
    <div class="row search-result-row" style="visibility:hidden;">
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

        <div class="row row-user-profile">

            <div class="col-sm-12 col-user-profile-image">
                <div class="div-user-image">
                    <img src="/storage/user-profile-images/{{ $user->image_id }}" class="user-image img-circle btn-upload-img pointer" data-toggle="tooltip" title="@lang('main.updatephoto')"/>
                </div>
            </div>
            <div class="col-sm-12 col-user-profile-actions">
                <div class="div-upload-image">
                    <!-- hidden form -->
                    <form name="uploader" id="example" action="/user/actions/uploadProfileImage" enctype="multipart/form-data" method="post" hidden>
                        <input type="file" name="image" id="input-upload-profile-image">
                        <input type="submit" id="upload_submit" value="Send">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token"   />
                    </form>
                    {{--
                    <button class="btn btn-default button-upload-profile-image">@lang('main.updatephoto')</button>
                    --}}
                </div>

                <div class="div-user-info">
                    <div class="form-group">
                          <label for="hashtag" class="text-center block">#hashtag</label>
                          <input type="text" class="form-control enter-handle" id="hashtag" value="{{ @$user->hashtag }}">
                    </div>

                    @if($user->status == 0)
                        <div class="form-group">
                            <label for="code" class="text-center block">@lang('main.confirmcode')</label>
                            <input type="text" class="form-control input-confirm-code" id="confirmcode" placeholder="insert code from e-mail">
                        </div>
                    @endif

                    <button class="btn btn-default button-update-profile">@lang('main.updateinfo')</button>

                    <div class="form-group text-center" style="margin-top:5px;">
                        <label for="locale" class="text-center block">@lang('main.setlocale')</label>
                        <a href="/user/setlocale/en" class="btn btn-default">EN</a>
                        <a href="/user/setlocale/ru" class="btn btn-default">RU</a>
                        <a href="/user/setlocale/az" class="btn btn-default">AZ</a>
                    </div>


                    <div class="alert alert-danger alert-hashtag" style="display:none;">
                      <strong>Not updated</strong> Sorry, this hashtag already exists
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-friends"
            data-load="0">
            <div class="col-sm-12">
                <div class="friends-list">
                    @include('layouts.includes.friends-list', ['permission' => 'user']);
                </div>
            </div>
        </div>
    @elseif($user->permission == 'guest')
        <div class="row search-result-row" style="visibility:hidden;">
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
        <div class="row row-user-profile">
            <div class="col-sm-12 col-user-profile-image">
                <div class="div-user-image">
                    <img src="/storage/user-profile-images/{{ $userprofile->image_id }}" class="user-image img-circle"/>
                </div>
            </div>
            <div class="col-sm-12 col-user-profile-actions">
                <div class="div-user-info">
                    <div class="form-group">
                      <label for="hashtag" class="text-center block" id="hashtag">{{ @$userprofile->hashtag }}</label>
                      {{--<input type="text" class="form-control" id="hashtag" value="{{ @$userprofile->hashtag }}" readonly>--}}
                    </div>
                    @if($is_friends['status'] == 1)
                        <button class="btn btn-success button-delete-friend">
                            @lang('main.unfollow') {{ @$userprofile->hashtag }}
                        </button>
                    @else
                        <button class="btn btn-primary button-add-friend" data-option="profile">
                            <span class="userprofile-follow-text">@lang('main.follow') {{ @$userprofile->hashtag }}</span>
                            <span class="userprofile-followed-text" style="display:none;">@lang('main.followed')</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row row-friends"
            data-load="0">
            <div class="col-sm-12">
                <div class="friends-list">
                    @include('layouts.includes.friends-list', ['permission' => 'guest']);
                </div>
            </div>
        </div>
        <div class="row chits-row">
            <div class="chits-list">
                @include("user.chits.chits-list-guest")
            </div>
        </div>
    @endif
</div>
@endsection
