<!-- 道の駅 -->
<div class="form-group">
  <label for="formGroupExampleInput">ZPX_ID</label>
  <input required pattern="^\d{1,2}-\d{1,3}$" value="@if(isset($roadstation['ZPX_ID'])){{ $roadstation['ZPX_ID'] }}@endif" name="roadstation[ZPX_ID]" type="text" class="form-control" id="formGroupExampleInput" placeholder="1-1">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">CID</label>
  <input required pattern="^\d{2}-\d{1}-\d{3}$" value="@if(isset($roadstation['CID'])){{ $roadstation['CID'] }}@endif" name="roadstation[CID]" type="text" class="form-control" id="formGroupExampleInput" placeholder="01-0-001">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">道の駅 名称</label>
  <input required value="@if(isset($roadstation['name'])){{ $roadstation['name'] }}@endif" name="roadstation[name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="道の駅">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">フリガナ</label>
  <input value="@if(isset($roadstation['name_furi'])){{ $roadstation['name_furi'] }}@endif" name="roadstation[name_furi]" type="text" class="form-control" id="formGroupExampleInput2" placeholder="ミチノエキ">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">キャッチコピー</label>
  <input value="@if(isset($roadstation['catch_copy'])){{ $roadstation['catch_copy'] }}@endif" name="roadstation[catch_copy]" type="text" class="form-control" id="formGroupExampleInput2" placeholder="道の駅">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">紹介文</label>
  <textarea name="roadstation[introduction]" class="form-control" id="exampleFormControlTextarea1" rows="3">
    @if(isset($roadstation['introduction'])){{ $roadstation['introduction'] }}@endif
  </textarea>
</div>
<div class="form-group">
  <label for="formGroupExampleInput">お土産</label>
  <input value="@if(isset($roadstation['gift'])){{ $roadstation['gift'] }}@endif" name="roadstation[gift]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="location-roads mb-5">
  <div class="form-group">
    <select name="localroad[0][location_road_type]" class="custom-select">
      <label for="formGroupExampleInput2">立地道路種別1</label>
      <option>道路種別を選択</option>
      <option 
        @if(isset($localroad[0]) && $localroad[0]->location_road_type == "1") selected @endif 
        value="1"
      >国道</option>
      <option
        @if(isset($localroad[0]) && $localroad[0]->location_road_type == "2") selected @endif 
        value="2"
      >公道</option>
      <option 
        @if(isset($localroad[0]) && $localroad[0]->location_road_type == "3") selected @endif 
        value="3"
      >その他</option>
    </select>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路番号1</label>
    <input pattern="^\d+$" value="@if(isset($localroad[0]->road_number)){{ $localroad[0]->road_number }}@endif" name="localroad[0][road_number]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路名称1</label>
    <input value="@if(isset($localroad[0]->road_name)){{ $localroad[0]->road_name }}@endif" name="localroad[0][road_name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <select name="localroad[1][location_road_type]" class="custom-select">
      <label for="formGroupExampleInput2">立地道路種別2</label>
      <option>道路種別を選択</option>
      <option 
        @if(!empty($localroad[1]) && $localroad[1]->location_road_type == "1") selected @endif 
        value="1"
      >国道</option>
      <option
        @if(isset($localroad[1]) && $localroad[1]->location_road_type == "2") selected @endif 
        value="2"
      >公道</option>
      <option 
        @if(isset($localroad[1]) && $localroad[1]->location_road_type == "3") selected @endif 
        value="3"
      >その他</option>
    </select>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路番号2</label>
    <input pattern="^\d+$" value="@if(isset($localroad[1]->road_number)){{ $localroad[1]->road_number }}@endif" name="localroad[1][road_number]" type="text" class="form-control" id="formGroupExampleInput" placeholder="00">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路名称2</label>
    <input value="@if(isset($localroad[1]->road_name)){{ $localroad[1]->road_name }}@endif" name="localroad[1][road_name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">標高</label>
    <div class="input-group">
      <input value="@if(isset($address->elebation)){{ $address->elebation }}@endif" name="address[elebation]" type="text" class="form-control" id="formGroupExampleInput" placeholder="約20m">
    </div>
  </div>
  @for ($i = 0; $i < 5; $i++)
  <div class="form-group">
    <label for="formGroupExampleInput">観光{{$i+1}}</label>
    <div class="input-group">
      <input value="@if(!empty($sightseeing[$i]->name)){{$sightseeing[$i]->name}}@endif" name="sightseeing[]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
    </div>
  </div>
  @endfor
</div>