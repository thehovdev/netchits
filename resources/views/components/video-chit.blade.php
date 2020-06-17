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

        <div class="chits-description-area">
            <div class="playerpreview-text">{{ $chit->title }}</div>
        </div>


        <div class="chits-events-area text-center">
            <i class="fa fa-archive fa-delete-chits chits-delete-button" id="{{ $chit->id }}" aria-hidden="true"></i>
        </div>
    </div>
</div>
