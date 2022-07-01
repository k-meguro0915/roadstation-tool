@include('components.formparts.main')
<!-- 施設一覧 -->
{{--
<div class="mb-5 facility-list d-flex flex-column align-items-center">
  <h3 class="text-center mb-5"><u>施設一覧</u></h3>
    @foreach($equipments as $key => $value)
    <li class="ml-3 d-inline btn-group">
      <button type="button" class="btn btn-primary mt-3"><?php print($value->name); ?></button>
      <button
        type="button"
        class="btn btn-primary mt-3"
        onclick="addFacilities('<?php print($value->id)?>','<?php print($value->name)?>')"
      >
        +
      </button>
    </li>
    @endforeach
</div>
--}}
<!-- 設備一覧 -->
<div class="mb-5 facility-list d-flex flex-column align-items-center">
  <h3 class="text-center mb-5"><u>サービス一覧</u></h3>
  <ul class="" style="list-style:none;">
    <?php foreach($facilities as $key => $value) {?>
    <li class="ml-3 d-inline">
      <label>
        <input
          id="service-checkbox-{{$value->id}}"
          style="display:none"
          type="checkbox"
          class="btn-check custom-control-input"
          autocomplete="off"
          name="service[]"
          onchange="changeIsService({{$value->id}})"
          value="{{$value->id}}"
          @if(array_search($value->id,array_column($roadstation_equipments, 'equipment_id')) !== false))) checked @endif
        >
        <span
          id="service-btn-<?php print($value->id)?>" class="btn @if(array_search($value->id,array_column($roadstation_equipments, 'equipment_id')) !== false)btn-primary @else btn-secondary @endif"
          for="customCheck<?php print($value->id)?>"
        >
          <?php print($value->name); ?>
        </span>
      </label>
    </li>
    <?php } ?>
  </ul>
</div>
@include('components.formparts.basicInformation')
@include('components.formparts.contacts')
@include('components.formparts.seasonalEvents')
<div id="facility-list"></div>
@include('components.formparts.facilitieCard')
<!-- submit -->
