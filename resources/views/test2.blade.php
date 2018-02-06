@extends('start.init')

@section('content')

<div id="buttons">
<label> <input id="query" value='cats' type="text"/><button id="search-button"    onclick="keyWordsearch()">Search</button></label>




<div id="container">
    <div id="results"></div>
</div>





<script>
    function keyWordsearch(){
    gapi.client.setApiKey('AIzaSyAnZa7brkDqvxkCDFMa2jrddqbFS44GMYE');
    gapi.client.load('youtube', 'v3', function(){
            makeRequest();
    });
    }
    function makeRequest(){
    var q = $('#query').val();
    var request = gapi.client.youtube.search.list({
            q: q,
            part: 'snippet',
            maxResults: 5
    });
    request.execute(function(response)  {
            $('#results').empty()
            var srchItems = response.result.items;
            $.each(srchItems, function(index, item){

            // console.info(item);

            // alert(item.id.videoId);

            console.info(item);

            videoId = item.id.videoId;
            vidTitle = item.snippet.title;
            vidThumburl =  item.snippet.thumbnails.medium.url;
            vidThumbimg = '<img id="thumb" src="'+vidThumburl+'" alt="No  Image  Available." class="search-item-img">';

            // $('#results').append('<div>' + vidTitle + '</div>' + vidThumbimg );


            $('#results').append(
                '<div class="col-sm-2 search-item" id="' + videoId + '">' +
                '<div class="search-item-img-block">' +
                vidThumbimg +
                '</div>' +
                '<div class="search-item-title">' +
                vidTitle +
                '</div>' +
                '</div>'
            );





    })
    })
    }
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>


































    <!-- <div id="buttons">
    <label> <input id="query" value='cats' type="text"/><button id="search-button"    onclick="keyWordsearch()">Search</button></label>
    <div id="container">
    <h1>Search Results</h1>
    <ul id="results"></ul>
    </div>
<script>
 function keyWordsearch(){
    gapi.client.setApiKey('AIzaSyAnZa7brkDqvxkCDFMa2jrddqbFS44GMYE');
    gapi.client.load('youtube', 'v3', function(){
            makeRequest();
    });
}
function makeRequest(){
    var q = $('#query').val();
    var request = gapi.client.youtube.search.list({
            q: q,
            part: 'snippet',
            maxResults: 10
    });
    request.execute(function(response)  {
            $('#results').empty()
            var srchItems = response.result.items;
            $.each(srchItems, function(index, item){

            // console.info(item);

            // alert(item.id.videoId);

            vidTitle = item.snippet.title;
            vidThumburl =  item.snippet.thumbnails.default.url;
            vidThumbimg = '<pre><img id="thumb" src="'+vidThumburl+'" alt="No  Image  Available." style="width:204px;height:128px"></pre>';

            $('#results').append('<pre>' + vidTitle + vidThumbimg +   '</pre>');
    })
  })
}
 </script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
 <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady">   </script> -->


@endsection
