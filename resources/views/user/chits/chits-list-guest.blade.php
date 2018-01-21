@php
use App\Models\User\ChitsModel;
$chitsModel = new ChitsModel;
@endphp

{{-- Если пользователь гость на странице пользователя --}}

    @if($chitsModel->has_default_chits($userprofile))
        <div class="row row-group">
                <div class="panel panel-default panel-group">
                  <div class="panel-body">Default</div>
                </div>
        </div>
        <div class="row row-chits-list">
            @foreach ($userChits as $chits)
                @if($chits->group_id == 0)
                        @if( is_youtube($chits->address) == 'yes')
                            <div class="chits-column-parent col-md-3 col-sm-3 col-xs-3" id="{{ $chits->id }}">
                                <div class="chits-column-image">
                                    <a>
                                        <iframe width="100%" height="100%" src="http://www.youtube.com/embed/{{ getcode_youtube($chits->address) }}?controls=2"
                                        frameborder="0" autoplay="1" allowfullscreen></iframe>
                                    </a>
                                </div>
                                <div class="chits-events">
                                    {{-- <i class="fa fa-trash-o fa-delete-chits chits-delete-button" aria-hidden="true"></i> --}}
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
                                {{--  <i class="fa fa-trash-o fa-delete-chits chits-delete-button" aria-hidden="true"></i> --}}
                                </div>
                            </div>
                        @endif
                @endif
            @endforeach
        </div>
    @endif

    @foreach ($userGroups as $userGroup)
        <div class="row row-group">
            <div class="panel panel-default panel-group" id="{{ $userGroup['id'] }}">
              <div class="panel-body">
                  {{ $userGroup['name'] }}
                  {{-- <i class="fa fa-window-close fa-delete-group chits-group-delete-button" aria-hidden="true"></i> --}}
              </div>
            </div>
        </div>
            @if($chitsByGroup = $chitsModel->getChitsByGroup($userprofile, $userGroup['id']))
                <div class="row row-chits-list">
                    @foreach ($chitsByGroup as $chits)
                        @if( is_youtube($chits->address) == 'yes')
                            <div class="chits-column-parent col-md-3 col-sm-3 col-xs-3" id="{{ $chits->id }}">
                                <div class="chits-column-image">
                                    <a>
                                        <iframe width="100%" height="100%" src="http://www.youtube.com/embed/{{ getcode_youtube($chits->address) }}?controls=2"
                                        frameborder="0" allowfullscreen></iframe>
                                    </a>
                                </div>
                                <div class="chits-events">
                                    {{--
                                    <i class="fa fa-trash-o fa-delete-chits chits-delete-button" aria-hidden="true"></i> --}}
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
                                    {{-- <i class="fa fa-trash-o fa-delete-chits chits-delete-button" aria-hidden="true"></i> --}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
    @endforeach
