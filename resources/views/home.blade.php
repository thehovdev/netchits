@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	
        <div class="col-md-8">
	    <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2 chits-add-column">
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
		    <button type="button" id="add-chit" class="btn btn-primary">Add Chit</button>
		    <select name="group">
			@if (sizeof($user->groups) > 0)
			    @foreach ($user->groups as $group)
				<option id="select-{{ $group->id }}" value="{{ $group->id }}">{{ $group->name }}</option>
			    @endforeach
			@else
			    <option value="0">Default</option>
			@endif
		    </select>
                </div>
		
		<div class="form-group">
		    <input type="text" class="form-control" id="group-name" placeholder="White Album">
		    <button type="button" id="add-group" class="btn btn-success">Add Group</button>
		</div>
            </div>
	    <div id="player" style="display: none;"></div>
	    <div class="alerts"></div>
	    
	    @if (sizeof($user->groups) > 0)
		@foreach ($user->groups as $group)
		    <div class="row row-group" id="group-{{ $group->id }}">
			<div class="panel panel-default panel-group">
			    <div class="panel-body">
				{{ $group->name }}
				<i class="fa fa-window-close fa-delete-group chits-group-delete-button" id="{{ $group->id }}" aria-hidden="true"></i>
			    </div>
			</div>
		    </div>
		    <div class="row row-chits-list" id="group-{{ $group->id }}-list">
			@foreach ($group->chits()->latest()->get() as $chit)
			    @if(Str::contains($chit->address, 'youtube'))
				<div class="chits-column-parent chit-code-{{ Str::after($chit->address, 'v=') }} col-md-3 col-sm-3 col-xs-3" id="chit-{{ $chit->id }}">

				    <div class="chits-player">
					<!-- Плеер -->
					<div class="playerblock" id="player-id-{{ Str::after($chit->address, 'v=') }}" data-video="{{ Str::after($chit->address, 'v=') }}">
					</div>
					<!-- Превью -->
					<div class="playerpreview" id="playerpreview">
					    <img src="//img.youtube.com/vi/{{ Str::after($chit->address, 'v=') }}/mqdefault.jpg" width="100%" height="150px">
					</div>
				    </div>

				    <div class="chits-events">

					<div class="chits-description-area" data-toggle="tooltip" title="{{ $chit->title }}">
					    <div class="playerpreview-text">{{ $chit->title }}</div>
					</div>


					<div class="chits-events-area">
					    <i class="fa fa-archive fa-delete-chits chits-delete-button" id="{{ $chit->id }}" aria-hidden="true"></i>
					</div>
				    </div>
				</div>
			    @else


				<div class="chits-column-parent col-lg-3 col-md-3 col-sm-3" id="chit-{{ $chit->id }}">
				    <div class="chits-column-block">
					<a class="chits-child" href="{{ $chit->address }}" target="_blank">
					    <div>
						@if(!is_null($chit->image))
						    <img src="{{ $chit->image }}" class="opg-image"/>
						@else
						    <img src="images/web.png" class="opg-image"/>
						@endif
						<div class="opg_title"><b>{{ $chit->title }}</b></div>
					    </div>
					</a>
				    </div>
				    <div class="chits-events">

					<div class="chits-description-area-basic" data-toggle="tooltip" title="{{ $chit->title }}">
					    <div class="preview-text">{{ $chit->title }}</div>
					</div>


					<div class="chits-events-area">
					    <i class="fa fa-archive fa-delete-chits chits-delete-button"  id="{{ $chit->id }}" aria-hidden="true"></i>
					</div>
				    </div>
				</div>
			    @endif
			@endforeach
		    </div>
		@endforeach
	    @endif
        </div>
    </div>
</div>
<script>
 // 2. This code loads the IFrame Player API code asynchronously.
 var tag = document.createElement('script');

 tag.src = "https://www.youtube.com/iframe_api";
 var firstScriptTag = document.getElementsByTagName('script')[0];
 firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

 // 3. This function creates an <iframe> (and YouTube player)
 //    after the API code downloads.
 var player;
 
 function onYouTubeIframeAPIReady() {
     var width = $('.chits-column-parent .chits-player').width();
     var height = $('.chits-column-parent .chits-player').height();
     player = new YT.Player('player', {
	 height: height,
	 width: width,
	 videoId: 'M7lc1UVf-VE',
	 events: {
	     'onReady': onPlayerReady,
	     'onStateChange': onPlayerStateChange
	 }
     });
 }

 // 4. The API will call this function when the video player is ready.
 function onPlayerReady(event) {
     event.target.playVideo();
 }

 // 5. The API calls this function when the player's state changes.
 //    The function indicates that when playing a video (state=1),
 //    the player should play for six seconds and then stop.
 var done = false;
 function onPlayerStateChange(event) {
     if (event.data == YT.PlayerState.PLAYING && !done) {
	 setTimeout(stopVideo, 6000);
	 done = true;
     }
 }
 function stopVideo() {
     player.stopVideo();
 }
 
 $(document).on('click', '.chits-player', function() {


     var playerblockId = $(this).find("div.playerblock").attr('id');
     var playerVideoId = $(this).find("div.playerblock").data('video');

     // var playerpreview = $(this).find("div.playerpreview").hide();
     var playerpreviewId = $(this).find("div.playerpreview").attr('id');
     // var position = $(this).closest('.chits-column-parent').position();
     var position = $(this).closest('.chits-column-parent').position();


     $('.playlist').val(playerVideoId);
     $('#player').show();

     player.loadVideoById({videoId: playerVideoId});

     var deviceWidth = $(window).width();



     switch (true) {

	 case (deviceWidth < 400 && deviceWidth > 300):
             $("#player").css({
		 "position": "absolute",
		 "top" : position.top + 53,
		 // "left" : position.left + 84,
		 "left" : position.left + 9,
		 "z-index" : "9",
             });
             break;

	 case (deviceWidth < 400):
             $("#player").css({
		 "position": "absolute",
		 "top" : position.top + 53,
		 "left" : position.left + 24,
		 "z-index" : "9",
             });
             break;

	 default :
             $("#player").css({
		 "position": "absolute",
		 "top" : position.top + 23,
		 "left" : position.left + 6,
		 "z-index" : "9",
             });
             break;

     }
 })

</script>
@endsection
