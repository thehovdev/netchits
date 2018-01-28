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


@endsection