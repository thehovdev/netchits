<div class="form-group">
  <select class="form-control" id="select-group">
          <option id="0">@lang('main.defaultgroup')</option>
      @foreach($userGroups as $userGroup)
          <option id="{{ $userGroup['id'] }}">{{ $userGroup['name']}}</option>
      @endforeach
  </select>
</div>
