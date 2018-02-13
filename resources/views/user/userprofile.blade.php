@extends('start.init')

@section('content')

@include('layouts.includes.navbar')

<div class="container">

    <div class="margin-top100"></div>


    @if($user->permission != 'guest')

        <div class="row row-user-profile">

            <div class="col-sm-12 col-user-profile-image">
                <div class="div-user-image">
                    <img src="/storage/user-profile-images/{{ $user->image_id }}" class="user-image img-circle"/>
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
                    <button class="btn btn-default button-upload-profile-image">@lang('main.updatephoto')</button>
                </div>

                <div class="div-user-info">
                    <div class="form-group">
                          <label for="hashtag" class="text-center block">#hashtag</label>
                          <input type="text" class="form-control" id="hashtag" value="{{ @$user->hashtag }}">
                    </div>

                    <div class="form-group text-center">
                          <label for="locale" class="text-center block">@lang('main.setlocale')</label>
                          <a href="/user/setlocale/en" class="btn btn-default">EN</a>
                          <a href="/user/setlocale/ru" class="btn btn-default">RU</a>
                          <a href="/user/setlocale/az" class="btn btn-default">AZ</a>
                    </div>

                    @if($user->status == 0)
                        <div class="form-group">
                            <label for="code" class="text-center block">@lang('main.confirmcode')</label>
                            <input type="text" class="form-control input-confirm-code" id="confirmcode" placeholder="insert code from e-mail">
                        </div>
                    @endif

                    <button class="btn btn-default button-update-profile">@lang('main.updateinfo')</button>

                    <div class="alert alert-danger alert-hashtag" style="display:none;">
                      <strong>Not updated</strong> Sorry, this hashtag already exists
                    </div>
                </div>
            </div>
        </div>
    @elseif($user->permission == 'guest')

    <div class="row row-user-profile">
        <div class="col-sm-12 col-user-profile-image">
            <div class="div-user-image">
                <img src="/storage/user-profile-images/{{ $userprofile->image_id }}" class="user-image img-circle"/>
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
                {{-- <button class="btn btn-default button-upload-profile-image">Update Photo</button> --}}
            </div>

            <div class="div-user-info">
                <div class="form-group">
                  <label for="hashtag" class="text-center block">#hashtag</label>
                  <input type="text" class="form-control" id="hashtag" value="{{ @$userprofile->hashtag }}" readonly>
                </div>

                <button class="btn btn-default button-delete-friend">@lang('main.deletefriend')</button>
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
