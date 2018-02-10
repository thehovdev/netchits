<div class="chits-column-parent col-lg-3 col-md-3 col-sm-3" id="{{ $chit->id }}">
    <div class="chits-column-block">
        <a class="chits-child" href="{{ $chit->address }}" target="_blank">
            <div>
                <img src="{{ $chit->opg_image }}" class="opg-image"/>
                <div class="opg_sitename">{{ $chit->opg_sitename }}</div>
                <div class="opg_title"><b>{{ $chit->opg_title }}</b></div>
            </div>
        </a>
    </div>
    <div class="chits-events">

        <div class="chits-description-area-basic">
            <div class="preview-text">{{ $chit->opg_title }}</div>
        </div>


        <div class="chits-events-area">
            <i class="fa fa-archive fa-delete-chits chits-delete-button" aria-hidden="true"></i>
        </div>
    </div>
</div>
