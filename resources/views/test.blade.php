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
    </style>


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

        //alert(videoId);

        var dataBlock = $('.chit-list').find('div#custom-player-id-' + videoId);
        var dataCode = dataBlock.data('video');
        //alert(dataCode);
        

        var dataParent = $(dataBlock).parent();
        var dataParentId = $(dataParent).attr('id');
        var dataParentClass = $(dataParent).attr('class');

        //alert(dataParentId);
        //alert(dataParentClass);


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
    function stopVideo() {
        player.stopVideo();
    }

    function playVideo() {
        player.playVideo();
    }


</script>
























{{--
    <div>
        <div id="player1"></div>
        <div id="player2"></div>
    </div>

    <div>
        <button id="stop">Detener Videos</button>
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
        videoId: 'iIE_yzfXsXY',
    }, {
        id: 'player2',
        height: '390',
        width: '640',
        videoId: 'pwbjX337Jj8'
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
            events: {
              'onReady': onPlayerReady,
              'onStateChange': onPlayerStateChange
            }
        });
    }


    function onPlayerReady(event) {
        alert('ready');
    }

    function onPlayerStateChange(event) {
        alert('changed');
    }

    $(document).ready(function () {
        //loop players array to stop them all
        $(players).each(function (i) {
            // console.log(this);
            var id = this.a.id;
            var state = event.data;
            console.info(state);
            if(state == 1) {
                console.info(this.getVideoUrl());
            }
            // state
            // 3 запуск
            // 2 паза
            // 1 продолжение
            var url = this.getVideoUrl();

        });
    })

</script> --}}

























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
