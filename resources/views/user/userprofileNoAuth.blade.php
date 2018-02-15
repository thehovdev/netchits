@extends('start.init')

@section('content')

@include('layouts.includes.navbar')

<div class="container">
    <div class="margin-top100"></div>
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
</div>
@endsection
