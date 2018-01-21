@extends('start.init')
@section('content')
    @include('layouts.includes.navbar')

    <div>
        <button id="stop">Detener Videos</button>
    </div>
    <div>
        <div id="player1"></div>
        <div id="player2"></div>
        <div id="player3"></div>
        <div id="player4"></div>
        <div id="player5"></div>
        <div id="player6"></div>
        <div id="player7"></div>
        <div id="player8"></div>
        <div id="player9"></div>
        <div id="player10"></div>
        <div id="player11"></div>
        <div id="player12"></div>
    </div>

    <script>


    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var playerInfoList = [{
        id: 'player1',
        height: '390',
        width: '640',
        videoId: 'iIE_yzfXsXY'
    }, {
        id: 'player2',
        height: '390',
        width: '640',
        videoId: 'pwbjX337Jj8'
    }, {
        id: 'player3',
        height: '390',
        width: '640',
        videoId: 'EMMN51rTlk8'
    }, {
        id: 'player4',
        height: '390',
        width: '640',
        videoId: 'UQbRBDDHfLw'
    }, {
        id: 'player5',
        height: '390',
        width: '640',
        videoId: 'mWfVha4mRUs'
    }, {
        id: 'player6',
        height: '390',
        width: '640',
        videoId: 'GrJNvuV27Uo'
    }, {
        id: 'player7',
        height: '390',
        width: '640',
        videoId: 'jLrYqt9uQew'
    }, {
        id: 'player8',
        height: '390',
        width: '640',
        videoId: 'MAhVU1CpMsg'
    }, {
        id: 'player9',
        height: '390',
        width: '640',
        videoId: 'PlRVVHzXA08'
    }, {
        id: 'player10',
        height: '390',
        width: '640',
        videoId: 'hroHQrv_l6U'
    }, {
        id: 'player11',
        height: '390',
        width: '640',
        videoId: '4ZXmnz2aEzU'
    }, {
        id: 'player12',
        height: '390',
        width: '640',
        videoId: '0cO309N22KE'
    }];

    function onYouTubeIframeAPIReady() {
        if (typeof playerInfoList === 'undefined') return;

        for (var i = 0; i < playerInfoList.length; i++) {
            var curplayer = createPlayer(playerInfoList[i]);
            players[i] = curplayer;
        }
    }

    var players = new Array();

    function createPlayer(playerInfo) {
        return new YT.Player(playerInfo.id, {
            height: playerInfo.height,
            width: playerInfo.width,
            videoId: playerInfo.videoId,
        });
    }

    $(document).ready(function () {
        $('#stop').click(function () {
            //loop players array to stop them all
            $(players).each(function (i) {
                console.log(this);
                this.stopVideo();
            });
        });
    })

</script>

























    {{--

    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->

    <div id="player"></div>

    <!-- <iframe id="player" type="text/html" width="640" height="360"
      src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com"
      frameborder="0"></iframe> -->

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
              player = new YT.Player('player', {
                height: '360',
                width: '640',
                videoId: '2Vv-BfVoq4g',
                events: {
                  'onReady': onPlayerReady,
                  'onStateChange': onPlayerStateChange
                }
          });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
          alert('ready');
        event.target.playVideo(); //auto play video
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
    </script> --}}



@endsection
