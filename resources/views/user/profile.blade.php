@extends('start.init')

@section('content')
    <page class="profilePage"></page>

    <!--Progress Bar-->
    <div class="bar search-progress-bar" style="visibility:hidden;">
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width: 100%">
            </div>
        </div>
    </div>

    <!--Main Navbar-->
    @include('layouts.includes.navbar')
    <!--Second Navbar-->
    {{-- @include('layouts.includes.second-navbar') --}}

    <!--Main Container-->
    <section class="chits-container">
        <div class="row">
            <div class="col-sm-12">

                <!-- Margin TOP FROM FIXED NAVBAR -->
                <div class="margin-top80"></div>

                @if($user->status == 0)
                    <div class="row account-confirm-row">
                        <div class="col-sm-12">
                            <a href="/user/{{ $user->id }}">
                                <div class="alert alert-info">
                                    <strong>@lang('main.attention')</strong>
                                    <p>
                                        @lang('main.confirmaccount')
                                    </p>
                                </div>
                            </a>

                            <div class="alert alert-info" style="margin-top:5px;">
                              <strong>Cookie <br></strong>@lang('main.cookie')
                            </div>

                        </div>
                    </div>
                @endif

                <!-- display friends search results -->
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


                            <!-- <button style="display:none;" class="btn btn-primary button-add-friend">
                                @lang('main.follow') <span class="search-user-hashtag" id="search-user-hashtag">#user</span>
                            </button>

                            <button style="display:none;" class="btn btn-primary button-is-friends">
                                @lang('main.followed') <span class="search-user-hashtag" id="search-user-hashtag">#user</span>
                            </button> -->

                        </div>
                    </div>
                </div>

                <!-- friends-list after click followers-->
                <div class="row row-friends"
                    data-load="0" style="display:none;">
                    <div class="col-sm-12">
                        <div class="friends-list">
                            @include('layouts.includes.friends-list', ['permission' => 'user'])
                        </div>
                    </div>
                </div>

                <!-- people-list -->
                <!-- <div class="row row-people-list">
                    <div class="col-sm-12">
                        <div class="people-list">
                            @include('layouts.includes.people-list')
                        </div>
                    </div>
                </div> -->

                <!-- add chits / group forms -->
                <div class="row chits-add-row">
                    <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2 chits-add-column">
                        <!-- <button type="button" class="btn btn-success button-add-chits button-add-chits-color" id="chits-add-button">@lang('main.addchit')
                        </button> -->

                        <button type="button" class="btn btn-success button-add-chits button-add-chits-search-color" id="chits-add-button" disabled>
                            <span class="bar-search-text">
                                @lang('main.search')
                            </span>

                            <span class="bar-add-text" style="display:none;">
                                @lang('main.addchit')
                            </span>
                        </button>


                    </div>
                    <div class="col-xs-3 col-lg-6 col-md-6 col-sm-6 chits-address-column">
                        <div class="form-group">


                          <input type="text" class="form-control" id="chits-address-input" placeholder="https://netchits.com">


                        </div>
                    </div>
                    <div class="col-xs-3 col-lg-3 col-md-3 col-sm-3 chitsgroup-select-column">
                        @include('layouts.includes.chitsgroup-select')
                    </div>
                </div>
                <div class="row chits-add-group-row">
                    <div class="chits-category">
                        <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2 chits-add-column">
                            <button type="button" class="btn btn-primary" id="chits-group-button">@lang('main.addgroup')</button>
                        </div>
                        <div class="col-xs-3 col-lg-6 col-md-6 col-sm-6 groupselect-column">
                            <div class="form-group">
                                <input type="text" class="form-control" id="chits-group-input" placeholder="AC/DC Playlist">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- display chits search results -->
                <div class="row chits-search-result">
                    <div class="results-parent">
                        <div id="results"></div>
                    </div>
                </div>

                <!-- chits list-->
                <div class="row chits-row">
                    <div class="chits-list" style="visibility:hidden;">
                        @include("user.chits.chits-list")
                    </div>
                </div>

            </div>
        </div>
    </section>




    <script>
        function keyWordsearch(){
        gapi.client.setApiKey('AIzaSyAnZa7brkDqvxkCDFMa2jrddqbFS44GMYE');
        gapi.client.load('youtube', 'v3', function(){
                makeRequest();

        });
        }
        function makeRequest(){
        var q = $('#chits-address-input').val();
        var request = gapi.client.youtube.search.list({
                q: q,
                part: 'snippet',
                maxResults: 8
        });
        request.execute(function(response)  {
                $('#results').empty()
                var srchItems = response.result.items;
                $.each(srchItems, function(index, item){

                console.info(item);

                // alert(item.id.videoId);

                videoId = item.id.videoId;
                channelId = item.snippet.channelId;


                    vidTitle = item.snippet.title;
                    vidThumburl =  item.snippet.thumbnails.medium.url;
                    vidThumbimg = '<img id="thumb" src="'+vidThumburl+'" alt="No  Image  Available." class="search-item-img">';




                    if(videoId) {
                        $('#results').append(
                            '<div class="search-item" id="' + videoId + '">' +
                            '<div class="search-item-img-block">' +
                            vidThumbimg +
                            '</div>' +
                            '<div class="search-item-title">' +
                            vidTitle +
                            '</div>' +
                            '<div class="search-item-actions">' +
                            '<button class="btn btn-default btn-loveit">' +
                            '<i class="fa fa-heart fa-love"></i>ilove' +
                            '</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    } else {

                        var channelUrl = 'https://www.youtube.com/channel/' + channelId;

                        $('#results').append(
                            '<div class="search-item"  id="' + channelId + '">' +
                            '<div class="search-item-img-block">' +
                            vidThumbimg +
                            '</div>' +
                            '<div class="search-item-title">' +
                            vidTitle +
                            '</div>' +
                            '<div class="search-item-actions">' +
                            '<a href="' + channelUrl + '" target="_blank">' +
                            '<button class="btn btn-default btn-channel">' +
                            '<i class="fa fa-external-link-square fa-search-link"></i>channel' +
                            '</button>' +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    }


                    $('.search-progress-bar').css('visibility', 'hidden');
                })
            })
        }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady">
    </script>

@endsection
