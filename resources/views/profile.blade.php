@extends('layouts.app')
@section('content')
    <div class="container">
	<div class="col-sm-12">
	    <div class="row row-user-profile">
		<div class="col-sm-12 col-user-profile-image">
		    <div class="div-user-image">
			<img src="{{ asset('images/' . $user->profile_picture) }}" class="user-image img-circle btn-upload-img pointer" id="btn-upload-img" data-toggle="tooltip" title="@lang('main.updatephoto')" />
				  </div>
				  </div>

				  <div class="center-block">
			<b class="text-center">{{ $user->hashtag }}</b>
			@if (auth()->check() && auth()->id() != $user->id)
			    @if (auth()->user()->isFollowing($user))
				<button class="btn btn-primary unfollow" id="{{ $user->id }}">Following</button>
			    @else
				<button class="btn btn-secondary follow" id="{{ $user->id }}">Follow</button>
			    @endif
			@endif
		    </div>
		    <div class="friends col-sm-12 mt-5">
			<div class="col-sm-4 offset-sm-4 col-xs-12 mt-5">
			    <div class="card card-default">
				<div class="card-body text-center">Followers</div>
			    </div>
			    
			    @if (sizeof($user->followers) > 0)
				@foreach($user->followers as $follower)
				    <a href="{{ route('user', $follower->id) }}"><img class="rounded" src="{{ asset('images/' . $follower->profile_picture) }}" width="50" height="50"></a>
				@endforeach
			    @endif
			</div>
			
			<div class="col-sm-4 offset-sm-4 col-xs-12 mt-5">
			    <div class="card card-default">
				<div class="card-body text-center">Followings</div>
			    </div>
			    @if (sizeof($user->followings) > 0)
				@foreach($user->followings as $following)
				    <a href="{{ route('user', $following->id) }}"><img class="rounded" src="{{ asset('images/' . $following->profile_picture) }}" width="50" height="50"></a>
				@endforeach
			    @endif
			</div>
		    </div>
		</div>
	    </div>
	    <div id="player" style="display: none;"></div>
	    @if (sizeof($user->groups) > 0)
		@foreach ($user->groups()->latest()->get() as $group)
		    <div class="row row-group" id="group-{{ $group->id }}">
			<div class="card panel-default panel-group">
			    <div class="card-body text-center">
				{{ $group->name }}
				@if (auth()->check() && auth()->id() == $user->id)
				    <i class="fa fa-window-close fa-delete-group chits-group-delete-button" id="{{ $group->id }}" aria-hidden="true"></i>
				@endif
			    </div>
			</div>
		    </div>
		    <div class="row chits-list-by-group col-md-12 offset-sm-1 col-sm-12" id="group-{{ $group->id }}-list">
			@foreach ($group->chits()->latest()->get() as $chit)
			    @if(Str::contains($chit->address, 'youtube'))
				<div class="chits-column-parent chit-code-{{ Str::after($chit->address, 'v=') }} col-sm-3 col-md-3 col-xs-12" id="chit-{{ $chit->id }}">

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

					@if (auth()->check() && auth()->id() == $user->id)
					    <div class="chits-events-area text-center">
						<i class="fa fa-archive fa-delete-chits chits-delete-button" id="{{ $chit->id }}" aria-hidden="true"></i>
					    </div>
					@endif
				    </div>
				</div>
			    @else


				<div class="chits-column-parent col-sm-3 col-md-3 col-xs-12" id="chit-{{ $chit->id }}">
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

					@if (auth()->check() && auth()->id() == $user->id)
					    <div class="chits-events-area text-center">
						<i class="fa fa-archive fa-delete-chits chits-delete-button"  id="{{ $chit->id }}" aria-hidden="true"></i>
					    </div>
					@endif
				    </div>
				</div>
			    @endif
			@endforeach
		    </div>
		@endforeach
	    @endif
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
		 var position = $(this).find('.playerpreview').offset();


		 $('.playlist').val(playerVideoId);
		 $('#player').show();

		 player.loadVideoById({videoId: playerVideoId});

		 var deviceWidth = $(window).width();



		 switch (true) {

		     case (deviceWidth < 400 && deviceWidth > 300):
			 $("#player").css({
			     "position": "absolute",
			     "top" : position.top,
			     // "left" : position.left + 84,
			     "left" : position.left,
			     "z-index" : "9",
			 });
			 break;
		     case (deviceWidth <= 450):
			 $("#player").css({
			     "position": "absolute",
			     "top" : position.top,
			     "left" : position.left,
			     "z-index" : "9",
			 });
			 break;
		     case (deviceWidth <= 768):
			 $("#player").css({
			     "position": "absolute",
			     "top": position.top,
			     "left": position.left,
			     "z-index": "9"
			 });
			 break;
		     default :
			 $('#player').css({
			     position: "absolute",
			     top: position.top,
			     left: position.left,
			     "z-index": "9",
			 });
			 break;

		 }
	     })

	    </script>
@endsection
