@extends('start.init')

@section('content')
    <page class="profilePage"></page>

    @include('layouts.includes.navbar')

    <section class="chits-container">
        <div class="container">

            <div class="row">
                <!--Sidebar-->
                <div class="col-sm-2">
                    <div class="sidebar-parent">
                        <div class="sidebar-content">
                            <ul class="list-group sidebar-list">
                                <li class="list-group-item sidebar-item btn" id="button-sidebar-add-chits">
                                    <span class="sidebar-item-text">Add Chits</span>
                                </li>
                                <li class="list-group-item sidebar-item btn" id="button-sidebar-add-groups">
                                    <span class="sidebar-item-text">Add Group</span>
                                </li>
                                <li class="list-group-item sidebar-item btn" id="button-sidebar-show-chits">
                                    <span class="sidebar-item-text">Chits</span>
                                </li>
                                <li class="list-group-item sidebar-item btn" id="button-sidebar-show-groups">
                                    <span class="sidebar-item-text">Groups</span>
                                </li>
                                <li class="list-group-item sidebar-item btn" id="button-sidebar-show-friends">
                                    <span class="sidebar-item-text">Friends</span>
                                </li>
                                <li class="list-group-item sidebar-item btn">
                                    <span class="sidebar-item-text">Respecs</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="col-sm-11 col-sm-offset-1">

                    <!-- Margin TOP FROM FIXED NAVBAR -->
                    <div class="margin-top80"></div>
                    <div class="row search-result-row" style="display:none;">
                        <div class="col-sm-12 search-result-col">
                            <div class="search-result-parent">
                                <img src="/storage/user-profile-images/" class="search-user-image img-circle"/>
                                <button class="btn btn-primary button-add-friend">
                                    Add Friend <span class="search-user-hashtag" id="search-user-hashtag">#user</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="row row-friends" data-load="0" style="display:none;">
                        <div class="col-sm-12">
                            <div class="friends-parent">
                                Friends
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="friends-list">
                                @include('layouts.includes.friends-list');
                            </div>
                        </div>
                    </div>




                    <div class="row chits-add-row" style="display:none;">
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
                    <div class="row chits-add-group-row" style="display:none;">
                        <div class="chits-category">
                            <div class="col-lg-2 col-md-2 col-sm-2 chits-add-column">
                                <button type="button" class="btn btn-primary" id="chits-group-button">Add Group</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
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
            </div>

        </div>
    </section>
@endsection
