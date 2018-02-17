<div class="form-group">
    <select class="form-control" id="select-group">
        @if(empty($userGroups))
            <option id="0">@lang('main.defaultgroup')</option>
        @else
            @foreach($userGroups as $userGroup)
                <option id="{{ $userGroup['id'] }}">{{ $userGroup['name']}}</option>
            @endforeach
        @endif
    </select>
</div>
