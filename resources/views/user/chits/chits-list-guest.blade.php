@php
use App\Models\User\ChitsModel;
$chitsModel = new ChitsModel;
@endphp

<input class="playlist" type="text" style="display:none;"/>
<div id="player" style="display:none;"></div>

@foreach ($userGroups as $userGroup)

    <div class="row row-group">
        <div class="panel panel-default panel-group" id="{{ $userGroup['id'] }}">
          <div class="panel-body">
              {{ $userGroup['name'] }}
              <i class="fa fa-cloud-download fa-copy-group chits-group-copy-button" aria-hidden="true"></i>
              <i class="fa fa-check-circle fa-copy-success" style="display:none;"></i>

          </div>
        </div>
    </div>


        @if($chitsByGroup = $chitsModel->getChitsByGroup($userprofile, $userGroup['id']))
            <div class="row row-chits-list">
                @foreach ($chitsByGroup as $chits)
                    @if( is_youtube($chits->address) == 'yes')

                        <div class="chits-column-parent chit-code-{{ getcode_youtube($chits->address) }} col-md-3 col-sm-3 col-xs-3" id="{{ $chits->id }}">

                            <div class="chits-player">
                                <!-- Плеер -->
                                <div class="playerblock" id="player-id-{{ getcode_youtube($chits->address) }}" data-video="{{ getcode_youtube($chits->address) }}">
                                </div>
                                <!-- Превью -->
                                <div class="playerpreview" id="playerpreview">
                                    <img src="//img.youtube.com/vi/{{ getcode_youtube($chits->address) }}/mqdefault.jpg" width="100%" height="150px">
                                </div>
                            </div>

                            <div class="chits-events">

                                <div class="chits-description-area" data-toggle="tooltip" title="{{ $chits->opg_title }}">
                                    <div class="playerpreview-text">{{ $chits->opg_title }}</div>
                                </div>


                                <div class="chits-events-area">
                                    <i class="fa fa-plus-square fa-copy-chits chits-copy-button" aria-hidden="true"></i>
                                    <i class="fa fa-check-circle fa-copy-success-small" style="display:none;"></i>

                                </div>
                            </div>
                        </div>





                    @else
                        <div class="chits-column-parent col-lg-3 col-md-3 col-sm-3" id="{{ $chits->id }}">
                            <div class="chits-column-block">
                                <a class="chits-child" href="{{ $chits->address }}" target="_blank">
                                    <div>
                                        @if(!is_null($chits->opg_image))
                                            <img src="{{ $chits->opg_image }}" class="opg-image"/>
                                        @else
                                            <img src="images/web.png" class="opg-image"/>
                                        @endif


                                        <div class="opg_sitename">{{ $chits->opg_sitename }}</div>
                                        <div class="opg_title"><b>{{ $chits->opg_title }}</b></div>
                                    </div>
                                </a>
                            </div>
                            <div class="chits-events">

                                <div class="chits-description-area-basic" data-toggle="tooltip" title="{{ $chits->opg_title }}">
                                    <div class="preview-text">{{ $chits->opg_title }}</div>
                                </div>


                                <div class="chits-events-area">
                                    <i class="fa fa-plus-square fa-copy-chits chits-copy-button" aria-hidden="true"></i>
                                    <i class="fa fa-check-circle fa-copy-success-small" style="display:none;"></i>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
@endforeach

<script type="text/javascript" src="{{ URL::asset('js/youtube.js') }}"></script>
