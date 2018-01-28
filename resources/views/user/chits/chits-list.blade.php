@php
use App\Models\User\ChitsModel;
$chitsModel = new ChitsModel;
@endphp

<input class="playlist" type="text" hidden />

@if($chitsModel->has_default_chits($user))

    <div class="row row-group">
            <div class="panel panel-default panel-group">
              <div class="panel-body">Default</div>
            </div>
    </div>

    <div class="row row-chits-list">
        @foreach ($userChits as $chits)
            @if($chits->group_id == 0)
                @if( is_youtube($chits->address) == 'yes')
                    <div class="chits-column-parent chit-code-{{ getcode_youtube($chits->address) }} col-md-3 col-sm-3 col-xs-3" id="{{ $chits->id }}">

                        <div class="chits-player">
                            <!-- Плеер -->
                            <div class="playerblock" id="player-id-{{ getcode_youtube($chits->address) }}" data-video="{{ getcode_youtube($chits->address) }}">
                            </div>
                            <!-- Превью -->
                            <div class="playerpreview" id="playerpreview">
                                <img src="//img.youtube.com/vi/{{ getcode_youtube($chits->address) }}/mqdefault.jpg" width="100%" height="150px">
                            </div>
                        </div>

                        <div class="chits-events">

                            <div class="chits-description-area">
                                <div class="playerpreview-text">{{ $chits->opg_title }}</div>
                            </div>


                            <div class="chits-events-area">
                                <i class="fa fa-trash-o fa-delete-chits chits-delete-button" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="chits-column-parent col-lg-3 col-md-3 col-sm-3" id="{{ $chits->id }}">
                            <div class="chits-column-block">
                                <a class="chits-child" href="{{ $chits->address }}" target="_blank">
                                    <div>
                                        <img src="{{ $chits->opg_image }}" class="opg-image"/>
                                        <div class="opg_sitename">{{ $chits->opg_sitename }}</div>
                                        <div class="opg_title"><b>{{ $chits->opg_title }}</b></div>
                                    </div>
                                </a>
                            </div>
                            <div class="chits-events">
                                <i class="fa fa-trash-o fa-delete-chits chits-delete-button" aria-hidden="true"></i>
                            </div>
                        </div>
                @endif
            @endif
        @endforeach
    </div>
@endif


<!-- <div class="chits-column-parent col-md-3 col-sm-3 col-xs-3" id="{{ $chits->id }}">
    <div class="chits-column-image">

    </div>
    <div class="chits-events">
        <i class="fa fa-trash-o fa-delete-chits chits-delete-button" aria-hidden="true"></i>

    </div>
</div> -->


<!-- JavaScript -->

<script>


      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      var player;



    function enableAutoPlay(videoId) {

        var dataBlock = $('.chits-list').find('div#player-id-' + videoId);
        var dataCode = dataBlock.data('video');




        var dataBlockId = $(dataBlock).attr('id');

        var playerpreview = $(dataBlock).closest('div.chits-player')
                                        .find('#playerpreview').show();






        var nextChitId = $("div.chit-code-" + dataCode).next().attr('id');
        alert(nextChitId);

        $('#' + nextChitId).find('.chits-player').click();

        return false;
    }




        $(".playlist").change(function(){
            var videoId = $(".playlist").val();
            setTimeout(function(){
                enableAutoPlay(videoId);
                }, 1000);
        });



        $('.chits-player').click(function() {

            var playerblockId = $(this).find("div.playerblock").attr('id');
            var playerVideoId = $(this).find("div.playerblock").data('video');
            var playerpreview = $(this).find("div.playerpreview").hide();


            if (typeof player != "undefined") {
                //player.destroy();
                $('#player').remove();
            }

            var playerblock = $(this).find('.playerblock');
            playerblock.append('<div id="player">' + '</div>');


            player = new YT.Player('player', {
                height: '150',
                width: '250',
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
