@extends('start.init')
@section('content')
    @include('layouts.includes.navbar')

    <style>

    body {
        margin-top:80px;
        padding:20px;
    }
    .chit {
        float:left;
        margin: auto;
        height:200px;
        width: 200px;
        background:yellow;
        cursor:pointer;
        margin:10px;
    }
    .chit2 {
        margin: auto;
        height:200px;
        width: 200px;
        background:green;
        cursor:pointer;
        float:left;
        margin:10px;

    }


    #playerblock, #playerblock2, #playerblock3 {
        display: block;
        margin: auto;
        width: 300px;
        height: 200px;
        background: gray;
        float: left;
        margin-right: 10px;
        cursor: pointer;
    }

    .connected {
        position: element(#playerblock);
        transform: translateX(-100%);
    }

    #player {
    }

    </style>

    <!-- <video width="320" height="240" controls>
      <source src="movie.mp4" type="video/mp4">
      <source src="movie.ogg" type="video/ogg">
          Your browser does not support the video tag.
    </video> -->
    <!-- <iframe width="200px" height="200px" src="http://www.youtube.com/embed/KUh2O8HylUM"
    frameborder="0" allowfullscreen >
    </iframe>

    <button> add Player</button> -->


    <div id="player"></div>

    <div id="playerblock" class="player-parent" data-videoid="zDo0H8Fm7d0"></div>

    <div id="playerblock2" class="player-parent" data-videoid="BldYlGqs7pA"></div>

    <div id="playerblock3" class="player-parent" data-videoid="TyHvyGVs42U"></div>


    <script>
      // Load the IFrame Player API code asynchronously.
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/player_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // Replace the 'ytplayer' element with an <iframe> and
      // YouTube player after the API code downloads.
      var player;


      function onYouTubePlayerAPIReady() {
        player = new YT.Player('player', {
          height: '200',
          width: '300',
          videoId: '-HjpL-Ns6_A',
          events: {
              'onStateChange': onPlayerStateChange
          }
        });
      }

      function onPlayerStateChange(event) {
        var state = player.getPlayerState()
        //alert(state);
    }


      $('.player-parent').click(function() {
        var id = $(this).attr('id')
        var videoId = $(this).data('videoid');

        var position = $('#' + id).position();


        player.loadVideoById(videoId);

        $("#player").css({
            "transition": "left 1s linear",
            "position": "absolute",
            "top" : position.top,
            "left" : position.left,
        });

      });

    </script>














{{--

    <input class="playlist" type="text"/>

    <div class="chit-list">
        <div id="chit" class="chit chit-code-GvbQzRAi4wM">
            <div class="playerblock" id="custom-player-id-GvbQzRAi4wM" data-video="GvbQzRAi4wM">
            </div>
        </div>
        <div id="chit2" class="chit chit-code-HCm6gRHINqA ">
            <div class="playerblock" id="custom-player-id-HCm6gRHINqA" data-video="HCm6gRHINqA">
            </div>
        </div>
    </div>


    <!-- JavaScript -->


<script>


      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      var player;


      function enableAutoPlay(videoId) {
        var dataBlock = $('.chit-list').find('div#custom-player-id-' + videoId);
        var dataCode = dataBlock.data('video');
        var dataParent = $(dataBlock).parent();
        var dataParentId = $(dataParent).attr('id');
        var dataParentClass = $(dataParent).attr('class');
        var nextChitId = $("div.chit-code-" + dataCode).next().attr('id');

        $('#' + nextChitId).click();
        return false;
    }

        $(".playlist").change(function(){
            var videoId = $(".playlist").val();
            setTimeout(function(){
                enableAutoPlay(videoId);
                }, 1000);
        });

        $('.chit').click(function() {

            // prod

            //alert($(this).attr('id'));


            var playerblockId = $(this).find("div.playerblock").attr('id');
            var playerVideoId = $(this).find("div.playerblock").data('video');
            var playerblockParent = $(this).attr('id');



            if (typeof player != "undefined") {
                //player.destroy();
                $('#player').remove();
            }



            var playerblock = $(this).find('.playerblock');
            playerblock.append('<div id="player">' + '</div>');


            //var myDiv1Para = $('#player-c');
            //myDiv1Para.attr('id', 'player');
            //myDiv1Para.appendTo('#' + playerblockId);


            //var myDiv1Para = $('#player').remove();
            //myDiv1Para.appendTo('#' + playerblockId);


            player = new YT.Player('player', {
                height: '200',
                width: '200',
                videoId: playerVideoId,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        })

      function onPlayerReady(event) {
        //alert('ready');
        player.playVideo();
      }

      var done = false;

      function onPlayerStateChange(event) {

        // если видео закончилось, включаем автопроигрывание
        var state = player.getPlayerState()
        //alert(state);
        if(state == 0) {
            // берем id текущего трэка
            var videoId = player.getVideoData()['video_id'];
            // удаляем текущий плеер
            player.destroy();

            // передаем управление функции автопроигрывания
            //enableAutoPlay(videoId);
            $('.playlist').val(videoId);
            $(".playlist").trigger("change");

        }

      }



</script>

--}}

@endsection
