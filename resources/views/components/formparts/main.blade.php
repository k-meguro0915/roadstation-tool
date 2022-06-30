<!-- 道の駅 -->
<div class="form-group">
  <label for="formGroupExampleInput">ZPX_ID</label>
  <input value="@if(isset($roadstation['roadstation'][0]->ZPX_ID)){{ $roadstation['roadstation'][0]->ZPX_ID }}@endif" name="roadstation[ZPX_ID]" type="text" class="form-control" id="formGroupExampleInput" placeholder="1-1">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">CID</label>
  <input value="@if(isset($roadstation['roadstation'][0]->CID)){{ $roadstation['roadstation'][0]->CID }}@endif" name="roadstation[CID]" type="text" class="form-control" id="formGroupExampleInput" placeholder="01-0-001">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">道の駅 名称</label>
  <input value="@if(isset($roadstation['roadstation'][0]->name)){{ $roadstation['roadstation'][0]->name }}@endif" name="roadstation[name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="道の駅">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">フリガナ</label>
  <input value="@if(isset($roadstation['roadstation'][0]->name_furi)){{ $roadstation['roadstation'][0]->name_furi }}@endif" name="roadstation[name_furi]" type="text" class="form-control" id="formGroupExampleInput2" placeholder="ミチノエキ">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">キャッチコピー</label>
  <input value="@if(isset($roadstation['roadstation'][0]->catch_copy)){{ $roadstation['roadstation'][0]->catch_copy }}@endif" name="roadstation[catch_copy]" type="text" class="form-control" id="formGroupExampleInput2" placeholder="道の駅">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">紹介文</label>
  <textarea name="roadstation[introduction]" class="form-control" id="exampleFormControlTextarea1" rows="3">@if(isset($roadstation['roadstation'][0]->introduction)){{ $roadstation['roadstation'][0]->introduction }}@endif
  </textarea>
</div>
<div class="form-group">
  <label for="formGroupExampleInput">お土産</label>
  <input value="@if(isset($roadstation['roadstation'][0]->gift)){{ $roadstation['roadstation'][0]->gift }}@endif" name="roadstation[gift]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="location-roads mb-5">
  <div class="form-group">
    <select name="localroad[0][location_road_type]" class="custom-select">
      <label for="formGroupExampleInput2">立地道路種別1</label>
      <option @if(!isset($roadstation['localroad'][0]->location_road_type)) checked @endif >道路種別を選択</option>
      <option 
        @if(isset($roadstation['localroad'][0]->location_road_type) && $roadstation['roadstation'][0]->location_road_type == "1") echo(checked) @endif 
        value="1"
      >国道</option>
      <option
        @if(isset($roadstation['localroad'][0]->location_road_type) && $roadstation['roadstation'][0]->location_road_type == "2") echo(checked) @endif 
        value="2"
      >公道</option>
      <option 
        @if(isset($roadstation['localroad'][0]->location_road_type) && $roadstation['roadstation'][0]->location_road_type == "3") echo(checked) @endif 
        value="3"
      >その他</option>
    </select>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路番号1</label>
    <input value="@if(isset($roadstation['localroad'][0]->road_number)){{ $roadstation['localroad'][0]->road_number }}@endif" name="localroad[0][road_number]" type="text" class="form-control" id="formGroupExampleInput" placeholder="00">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路名称1</label>
    <input value="@if(isset($roadstation['localroad'][0]->road_name)){{ $roadstation['localroad'][0]->road_name }}@endif" name="localroad[0][road_name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <select name="localroad[1][location_road_type]" class="custom-select">
      <label for="formGroupExampleInput2">立地道路種別2</label>
      <option @if(!isset($roadstation['localroad'][1]->location_road_type)) checked @endif >道路種別を選択</option>
      <option 
        @if(isset($roadstation['localroad'][1]->location_road_type) && $roadstation['roadstation'][1]->location_road_type == "1") echo(checked) @endif 
        value="1"
      >国道</option>
      <option
        @if(isset($roadstation['localroad'][1]->location_road_type) && $roadstation['roadstation'][1]->location_road_type == "2") echo(checked) @endif 
        value="2"
      >公道</option>
      <option 
        @if(isset($roadstation['localroad'][1]->location_road_type) && $roadstation['roadstation'][1]->location_road_type == "3") echo(checked) @endif 
        value="3"
      >その他</option>
    </select>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路番号2</label>
    <input value="@if(isset($roadstation['localroad'][1]->road_number)){{ $roadstation['localroad'][1]->road_number }}@endif" name="localroad[1][road_number]" type="text" class="form-control" id="formGroupExampleInput" placeholder="00">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路名称2</label>
    <input value="@if(isset($roadstation['localroad'][1]->road_name)){{ $roadstation['localroad'][1]->road_name }}@endif" name="localroad[1][road_name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">標高</label>
    <div class="input-group">
      <input value="@if(isset($roadstation['address']->elebation)){{ $roadstation['address']->elebation }}@endif" name="address[elebation]" type="text" class="form-control" id="formGroupExampleInput" placeholder="00">
    </div>
  </div>
  @for ($i = 1; $i <= 5; $i++)
  <div class="form-group">
    <label for="formGroupExampleInput">観光{{$i}}</label>
    <div class="input-group">
      <input value="" name="sightseeing[]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
    </div>
  </div>
  @endfor
</div>