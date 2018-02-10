<div class="chits-column-parent chit-code-{{ getcode_youtube($chit->address) }} col-md-3 col-sm-3 col-xs-3" id="{{ $chit->id }}">

    <div class="chits-player">
        <!-- Плеер -->
        <div class="playerblock" id="player-id-{{ getcode_youtube($chit->address) }}" data-video="{{ getcode_youtube($chit->address) }}">
        </div>
        <!-- Превью -->
        <div class="playerpreview" id="playerpreview">
            <img src="//img.youtube.com/vi/{{ getcode_youtube($chit->address) }}/mqdefault.jpg" width="100%" height="150px">
        </div>
    </div>

    <div class="chits-events">

        <div class="chits-description-area">
            <div class="playerpreview-text">{{ $chit->opg_title }}</div>
        </div>


        <div class="chits-events-area">
            <i class="fa fa-archive fa-delete-chits chits-delete-button" aria-hidden="true"></i>
        </div>
    </div>
</div>
