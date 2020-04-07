<div class="row row-group" id="group-{{ $group->id }}">
  <div class="panel panel-default panel-group">
    <div class="panel-body">
      {{ $group->name }}
      <i class="fa fa-window-close fa-delete-group chits-group-delete-button" id="{{ $group->id }}" aria-hidden="true"></i>
    </div>
  </div>
</div>
<div class="row row-chits-list" id="group-{{ $group->id }}-list">
</div>
