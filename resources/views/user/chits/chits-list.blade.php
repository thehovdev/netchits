@php

use App\Models\User\ChitsModel;
$chitsModel = new ChitsModel;

@endphp

@if($chitsModel->has_default_chits($user))
    <div class="row row-group">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12 group-column"> -->
            <div class="panel panel-default panel-group">
              <div class="panel-body">Default</div>
            </div>
        <!-- </div> -->
    </div>
    
    <div class="row row-chits-list">
        @foreach ($userChits as $chits)
            @if(is_null($chits->group_id))
                <div class="row row-chits-list">
                    @if( is_youtube($chits->address) == 'yes')
                        <div class="chits-column-parent col-md-2 col-sm-2 col-xs-2" id="{{ $chits->id }}">
                            <div class="chits-column-image">
                                <a href="{{ $chits->address }}" target="_blank">
                                    <img src="http://img.youtube.com/vi/{{ getcode_youtube($chits->address) }}/mqdefault.jpg"
                                         width="100%" height="100%" />
                                </a>
                            </div>
                            <div class="chits-events">
                                <button type="button" class="btn btn-danger button-delete chits-delete-button">Delete</button>
                            </div>
                        </div>
                    @else
                        <div class="chits-column-parent col-lg-2 col-md-2 col-sm-2" id="{{ $chits->id }}">
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
                                <button type="button" class="btn btn-danger button-delete chits-delete-button">Delete</button>
                            </div>
                        </div>
                    @endif
            @endif
        @endforeach
    </div>
@endif



@foreach ($userGroups as $userGroup)
    <div class="row row-group">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12 group-column"> -->
            <div class="panel panel-default panel-group">
              <div class="panel-body">{{ $userGroup['name']}}</div>
            </div>
        <!-- </div> -->

    </div>
        @if($chitsByGroup = $chitsModel->getChitsByGroup($user, $userGroup['id']))
            <div class="row row-chits-list">
                @foreach ($chitsByGroup as $chits)
                    @if( is_youtube($chits->address) == 'yes')
                        <div class="chits-column-parent col-md-2 col-sm-2 col-xs-2" id="{{ $chits->id }}">
                            <div class="chits-column-image">
                                <a href="{{ $chits->address }}" target="_blank">
                                    <img src="http://img.youtube.com/vi/{{ getcode_youtube($chits->address) }}/mqdefault.jpg"
                                         width="100%" height="100%" />
                                </a>
                            </div>
                            <div class="chits-events">
                                <button type="button" class="btn btn-danger button-delete chits-delete-button">Delete</button>
                            </div>
                        </div>
                    @else
                        <div class="chits-column-parent col-lg-2 col-md-2 col-sm-2" id="{{ $chits->id }}">
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
                                <button type="button" class="btn btn-danger button-delete chits-delete-button">Delete</button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
@endforeach











































{{-- @foreach ($userChits as $userChit)
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
@endforeach --}}
