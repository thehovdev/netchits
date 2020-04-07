var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('playerf', {
        height: '360',
        width: '640',
        videoId: 'ByHuAUwdbe8',
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

function submitLoadVideoById() {
    var videoId = document.getElementById("loadVideoById").value;
    player.loadVideoById({videoId: videoId});
}

function submitLoadVideoByURL() {
    var url = document.getElementById("loadVideoByUrl").value;
    player.loadVideoByUrl({mediaContentUrl: url});
}

function submitLoadPlaylist() {
    var playlistString = document.getElementById("loadPlaylist").value;
    var playlist = playlistString.split(',');
    player.loadPlaylist({playlist: playlist});
}

function submitCueVideoById() {
    var videoId = document.getElementById("cueVideoById").value;
    player.cueVideoById({videoId: videoId});
}

function submitCueVideoByURL() {
    var url = document.getElementById("cueVideoByUrl").value;
    player.cueVideoByUrl({mediaContentUrl: url});
}

function submitCuePlaylist() {
    var playlistString = document.getElementById("cuePlaylist").value;
    var playlist = playlistString.split(',');
    player.cuePlaylist({playlist: playlist});
}

// Log state changes
function onStateChange(event) {
    var time = getTime();
    var state = "undefiend";
    switch (event.data) {
    case YT.PlayerState.UNSTARTED:
        state= "unstarted";
        break;
    case YT.PlayerState.ENDED:
        state = "ended";
        break;
    case YT.PlayerState.PLAYING:
        state = "playing";
        break;
    case YT.PlayerState.PAUSED:
        state = "paused";
        break;
    case YT.PlayerState.BUFFERING:
        state = "buffering";
        break;
    case YT.PlayerState.CUED:
        state = "video cued";
        break;
    default:
        state = "unknown (" + event.data + ")";
    }
    
    console.log('onStateChange: ' + state);
    theHistory = state + time + "<br/>" + theHistory;
    document.getElementById("history_div").innerHTML = theHistory;
}

// Log any errors
function onError(event) {
    var time =  getTime();
    var error = "undefined";
    switch (event.data) {
    case 2:
        error = "Invalid parameter value";
        break;
    case 5:
        error = "HTML 5 related error";
        break;
    case 100:
        error = "Video requested is not found";
        break;
    case 101:
        error = "Embedded playback forbidden by ownder";
        break;
    case 150:
        error = "Error processing video request";
        break;
    default:
        error = "unknown (" + event.data + ")";
    }
    console.log ("onError: " + error + time);
    theHistory = "<p class='error'>" + error + time +"</p>" + theHistory;
    document.getElementById("history_div").innerHTML = theHistory
}

function getTime() {
    var d = new Date();
    var currentTime = d.getTime();
    if (startTime == -1)
        startTime = currentTime;
    var elapsed = currentTime - startTime;
    var theTime = " (" + elapsed + " ms)";
    return theTime;
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




