<div class="row row-group" id="group-id-{{ $group->id }}">
    <div class="panel panel-default panel-group" id="{{ $group->id }}">
      <div class="panel-body">
          {{ $group->name }}
          <i class="fa fa-window-close fa-delete-group chits-group-delete-button" aria-hidden="true"></i>
      </div>
    </div>
</div>
<div class="row row-chits-list" id="group-id-{{ $group->id }}-list">
</div>
