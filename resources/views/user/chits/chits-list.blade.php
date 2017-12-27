    @foreach ($userChits as $userChit)
        @if( is_youtube($userChit->address) == 'yes')
            <div class="chits-column-image bg-primary col-lg-2 col-md-2 col-sm-2" id="{{ $userChit->id }}">
                <a href="{{ $userChit->address }}" target="_blank">
                    <img src="http://img.youtube.com/vi/{{ getcode_youtube($userChit->address) }}/mqdefault.jpg"
                         width="100%" height="100%" />
                </a>
                    <button type="button" class="btn btn-danger button-delete chits-delete-button">Delete</button>
            </div>
        @else

            <div class="chits-column col-lg-2 col-md-2 col-sm-2" id="{{ $userChit->id }}">
                    <a class="chits-child" href="{{ $userChit->address }}" target="_blank">
                        <div>
                            <img src="{{ $userChit->opg_image }}" class="opg-image"/>
                            <div class="opg_sitename">{{ $userChit->opg_sitename }}</div>
                            <div class="opg_title"><b>{{ $userChit->opg_title }}</b></div>

                        </div>
                    </a>
                    <button type="button" class="btn btn-danger button-delete chits-delete-button">Delete</button>
            </div>
        @endif
    @endforeach
