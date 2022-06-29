<div class="form-group">
  <label for="formGroupExampleInput">イベント情報①</label>
  <input value="@if(!empty($events[0])){{ $events[0] }}@endif" name="event[]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">イベント情報②</label>
  <input value="@if(!empty($events[1])){{ $events[1] }}@endif" name="event[]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">イベント情報③</label>
  <input value="@if(!empty($events[2])){{ $events[2] }}@endif" name="event[]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
</div>