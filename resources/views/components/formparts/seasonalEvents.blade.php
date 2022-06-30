<!-- 旬のイベント情報 -->
<div class="events mb-5">
  <h3 class="text-center mb-2"><u>開催中のイベント</u></h3>
  <div class="form-group">
    <label for="formGroupExampleInput">イベントタイトル1</label>
    <input value="@if(isset($roadstation['event'][0]->title)){{ $roadstation['event'][0]->title }}@endif" name="event[0][title]" type="text" class="form-control" id="formGroupE	xampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">イベント内容1</label>
    <input value="@if(isset($roadstation['event'][0]->content)){{ $roadstation['event'][0]->content }}@endif" name="event[0][content]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">開始日1</label>
    <input value="@if(isset($roadstation['event'][0]->start_time)){{ $roadstation['event'][0]->start_time }}@endif" name="event[0][start_time]" type="date" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">終了日1</label>
    <input value="@if(isset($roadstation['event'][0]->end_time)){{ $roadstation['event'][0]->end_time }}@endif" name="event[0][end_time]" type="date" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">イベントタイトル2</label>
    <input value="@if(isset($roadstation['event'][1]->title)){{ $roadstation['event'][1]->title }}@endif" name="event[1][title]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">イベント内容2</label>
    <input value="@if(isset($roadstation['event'][1]->content)){{ $roadstation['event'][1]->content }}@endif" name="event[1][content]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">開始日2</label>
    <input value="@if(isset($roadstation['event'][1]->start_time)){{ $roadstation['event'][1]->start_time }}@endif" name="event[1][start_time]" type="date" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">終了日2</label>
    <input value="@if(isset($roadstation['event'][1]->end_time)){{ $roadstation['event'][1]->end_time }}@endif" name="event[1][end_time]" type="date" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">イベントタイトル3</label>
    <input value="@if(isset($roadstation['event'][2]->title)){{ $roadstation['event'][2]->title }}@endif" name="event[2][title]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">イベント内容3</label>
    <input value="@if(isset($roadstation['event'][2]->content)){{ $roadstation['event'][2]->content }}@endif" name="event[2][content]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">開始日3</label>
    <input value="@if(isset($roadstation['event'][2]->start_time)){{ $roadstation['event'][2]->start_time }}@endif" name="event[2][start_time]" type="date" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">終了日3</label>
    <input value="@if(isset($roadstation['event'][2]->end_time)){{ $roadstation['event'][2]->end_time }}@endif" name="event[2][end_time]" type="date" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-check form-check-inline">
    <input 
      @if(isset($roadstation['eventFlag'][0]->is_closed) && $roadstation['eventFlag'][0]->is_closed == 1){{ checked }} @endif
      name="eventFlag[is_closed]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1"
    >
    <label class="form-check-label" for="inlineCheckbox1">休業</label>
  </div>
  <div class="form-check form-check-inline">
    <input 
      @if(isset($roadstation['eventFlag'][0]->is_shutdown) && $roadstation['eventFlag'][0]->is_shutdown == 1){{ checked }} @endif
      name="eventFlag[is_shutdown]" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="1"
    >
    <label class="form-check-label" for="inlineCheckbox2">閉鎖</label>
  </div>
</div>