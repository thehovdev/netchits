@extends('start.init')

@section('content')
    <page class="profilePage"></page>

    @include('layouts.includes.navbar')

    <section class="chits-container">
        <div class="container">

            <div class="margin-top80"></div>

            <div class="row search-result-row" style="display:none;">
                <div class="col-sm-12 search-result-col">
                    <div class="search-result-parent">
                        <img src="/storage/user-profile-images/{{ $user->image_id }}" class="search-user-image img-circle"/>
                        <button class="btn btn-success">Add Friend</button>
                    </div>
                </div>
            </div>

            <div class="row chits-add-row">
                <div class="col-lg-2 col-md-2 col-sm-2 chits-add-column">
                    <button type="button" class="btn btn-success" id="chits-add-button">Add New</button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="chits-address-input" placeholder="https://netchits.com">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 chitsgroup-select-column">
                    @include('layouts.includes.chitsgroup-select')
                </div>
            </div>

            <div class="row chits-add-group-row">
                <div class="chits-category">
                    <div class="col-lg-2 col-md-2 col-sm-2 chits-add-column">
                        <button type="button" class="btn btn-primary" id="chits-group-button">Add Group</button>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" id="chits-group-input" placeholder="https://netchits.com">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row chits-row">

                <div class="chits-list">
                    @include("user.chits.chits-list")
                </div>
            </div>
        </div>
    </section>
@endsection
