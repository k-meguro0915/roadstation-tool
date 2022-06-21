<!-- 道の駅 -->
<div class="imagePreview"></div>
<div class="input-group">
  <label class="input-group-btn">
    <span class="btn btn-primary">
      写真をアップロード<input type="file" style="display:none" class="uploadFile">
    </span>
  </label>
  <input type="text" class="form-control" readonly="">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">CID</label>
  <input value="@if(isset($roadstation['roadstation'][0]->CID)){{ $roadstation['roadstation'][0]->CID }}@endif" name="roadstation[CID]" type="text" class="form-control" id="formGroupExampleInput" placeholder="CID">
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
<div class="location-roads mb-5">
  <div class="form-group">
    <select name="localroad[road_type]" class="custom-select">
      <label for="formGroupExampleInput2">立地道路種別</label>
      <option @if(!isset($roadstation['localroad'][0]->road_type)) checked @endif >道路種別を選択</option>
      <option 
        @if(isset($roadstation['localroad'][0]->road_type) && $roadstation['roadstation'][0]->road_type == "1") echo(checked) @endif 
        value="1"
      >国道</option>
      <option
        @if(isset($roadstation['localroad'][0]->road_type) && $roadstation['roadstation'][0]->road_type == "2") echo(checked) @endif 
        value="2"
      >公道</option>
      <option 
        @if(isset($roadstation['localroad'][0]->road_type) && $roadstation['roadstation'][0]->road_type == "3") echo(checked) @endif 
        value="3"
      >その他</option>
    </select>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路番号</label>
    <input value="@if(isset($roadstation['localroad'][0]->road_number)){{ $roadstation['localroad'][0]->road_number }}@endif" name="localroad[road_number]" type="text" class="form-control" id="formGroupExampleInput" placeholder="00">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">道路名称</label>
    <input value="@if(isset($roadstation['localroad'][0]->road_name)){{ $roadstation['localroad'][0]->road_name }}@endif" name="localroad[road_name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">標高</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">約</span>
      </div>
      <input value="@if(isset($roadstation['address'][0]->elebation)){{ $roadstation['address'][0]->elebation }}@endif" name="address[elebation]" type="text" class="form-control" id="formGroupExampleInput" placeholder="00">
      <div class="input-group-append">
        <span class="input-group-text">m</span>
      </div>
    </div>
  </div>
</div>