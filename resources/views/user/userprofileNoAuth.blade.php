@extends('start.init')

@section('content')

@include('layouts.includes.navbar')

<input type="hidden" id="hiddentitle" value="Netchits {{ $userprofile->hashtag }} profile"></input>


<!--Progress Bar-->
<div class="bar search-progress-bar" style="visibility:hidden;">
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width: 100%">
        </div>
    </div>
</div>

<div class="margin-top100"></div>
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
                </div>
                <button class="btn btn-primary button-add-friend" data-option="noauth">
                    <span class="userprofile-follow-text">@lang('main.follow') {{ @$userprofile->hashtag }}</span>
                </button>
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
@endsection
