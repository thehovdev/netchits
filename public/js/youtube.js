var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;


function onYouTubePlayerAPIReady() {

    // for youtube player
    var width = $('.chits-column-parent .chits-player').width();
    var height = $('.chits-column-parent .chits-player').height();


        // проверить, если это iphone то, иначе
    	// if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
        //
    	// } else {
        //
    	// }








    player = new YT.Player('player', {
      height: height,
      width: width,
      videoId: '-HjpL-Ns6_A',
      events: {
          'onStateChange': onPlayerStateChange,
          'onPlayerReady': onPlayerReady
      }
    });




}

function enableAutoPlay(videoId) {


    // alert(videoId);

    var position = $('.chits-list').find('div.chit-code-' + videoId).position();
    // alert(position.top);

    var dataBlock = $('.chits-list').find('div#player-id-' + videoId);
    var dataCode = dataBlock.data('video');
    var dataBlockId = $(dataBlock).attr('id');


    var nextChitId = $("div.chit-code-" + dataCode).next().attr('id');


    if( typeof nextChitId === 'undefined' || nextChitId === null ){
        var nextChitId = $("div.chits-column-parent").first().attr('id');
    }

    $('#' + nextChitId).find('.chits-player').click();

}

$(".playlist").change(function(){
    var videoId = $(".playlist").val();
    setTimeout(function(){
        enableAutoPlay(videoId);
        }, 1000);
});


window.onload = function() {
    $('.chits-list').css('visibility', 'visible');
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

    player.loadVideoById(playerVideoId);

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



    // if(deviceWidth < 400) {
    //     $("#player").css({
    //         "position": "absolute",
    //         "top" : position.top + 53,
    //         "left" : position.left + 24,
    //         "z-index" : "9",
    //     });
    // } else {
    //     $("#player").css({
    //         "position": "absolute",
    //         "top" : position.top + 23,
    //         "left" : position.left + 6,
    //         "z-index" : "9",
    //     });
    // }




    //
    // $("#player").css({
    //     "position": "absolute",
    //     "top" : position.top + 23,
    //     "left" : position.left + 6,
    //     "z-index" : "9",
    // });


})


function onPlayerReady(event) {
  //
}

var done = false;

function onPlayerStateChange(event) {
    // если видео закончилось, включаем автопроигрывание
    var state = player.getPlayerState()
    //alert(state);
    if(state == 0) {
        // берем id текущего трэка
        var videoId = player.getVideoData()['video_id'];

        // передаем управление функции автопроигрывания
        //enableAutoPlay(videoId);
        $('.playlist').val(videoId);
        $(".playlist").trigger("change");

    }
}
