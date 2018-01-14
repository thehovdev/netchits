@extends('start.init')

@section('content')

@include('layouts.includes.navbar')
<div class="container">
    <div class="row row-user-profile">
        <div class="col-sm-12 col-user-profile-image">
            <div class="div-user-image">
                <img src="/images/{{ $user->image_id }}.png" class="user-image"/>
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


                <button class="btn btn-default button-upload-profile-image">Choose File</button>

            </div>
        </div>

    </div>
</div>
@endsection
