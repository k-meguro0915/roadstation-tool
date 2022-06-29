<div class="form-check pl-0">
  <label class="form-check-label" for="japanese">和食</label>
  <input name="restaurant[japanese_food]" class="form-check-input mx-2" type="checkbox" value="1" id="japanese" @if(!empty($restaurant['japanese_food'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="western_food">洋食・西洋料理</label>
  <input name="restaurant[western_food]" class="form-check-input mx-2" type="checkbox" value="1" id="western_food" @if(!empty($restaurant['western_food'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="chinese_food">中華料理・韓国料理・アジア・エスニック</label>
  <input name="restaurant[chinese_food]" class="form-check-input mx-2" type="checkbox" value="1" id="chinese_food" @if(!empty($restaurant['chinese_food'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="sweets">スイーツ</label>
  <input name="restaurant[sweets]" class="form-check-input mx-2" type="checkbox" value="1" id="sweets" @if(!empty($restaurant['sweets'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="bar">お酒・バー</label>
  <input name="restaurant[bar]" class="form-check-input mx-2" type="checkbox" value="1" id="bar" @if(!empty($restaurant['bar'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="eat_in">イートイン</label>
  <input name="restaurant[eat_in]" class="form-check-input mx-2" type="checkbox" value="1" id="eat_in" @if(!empty($restaurant['eat_in'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="take_out">テイクアウト</label>
  <input name="restaurant[take_out]" class="form-check-input mx-2" type="checkbox" value="1" id="take_out" @if(!empty($restaurant['take_out'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="buffet">ビュッフェ</label>
  <input name="restaurant[buffet]" class="form-check-input mx-2" type="checkbox" value="1" id="buffet" @if(!empty($restaurant['buffet'])) checked @endif>
</div>