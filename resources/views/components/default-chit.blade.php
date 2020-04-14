<div class="chits-column-parent col-md-3 col-sm-3" id="chit-{{ $chit->id }}">
    <div class="chits-column-block">
        <a class="chits-child" href="{{ $chit->address }}" target="_blank">
            <div>
                <img src="{{ $chit->image }}" class="opg-image" />
                <div class="opg_title"><b>{{ $chit->title }}</b></div>
            </div>
        </a>
    </div>
    <div class="chits-events">

        <div class="chits-description-area-basic">
            <div class="preview-text">{{ $chit->title }}</div>
        </div>


        <div class="chits-events-area text-center">
            <i class="fa fa-archive fa-delete-chits chits-delete-button" id="{{ $chit->id }}" aria-hidden="true"></i>
        </div>
    </div>
</div>
