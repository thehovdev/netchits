<div class="row row-group" id="group-{{ $group->id }}">
  <div class="card panel-default panel-group">
    <div class="card-body text-center">
      {{ $group->name }}
      <i class="fa fa-window-close fa-delete-group chits-group-delete-button" id="{{ $group->id }}" aria-hidden="true"></i>
    </div>
  </div>
</div>
<div class="row row-chits-list" id="group-{{ $group->id }}-list">
</div>
