<div class="form-group">
  <label for="formGroupExampleInput">ZPX_ID</label>
  <input require pattern="^\d-\d$" value="@if(isset($facility['ZPX_ID'])){{ $facility['ZPX_ID'] }}@endif" name="facility[ZPX_ID]" type="text" class="form-control" id="formGroupExampleInput" placeholder="1-1">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">施設-カテゴリーコード</label>
  <input require pattern="^\d{4}$" value="@if(isset($facility['facility_category_code'])){{ $facility['facility_category_code'] }}@endif" name="facility[facility_category_code]" type="text" class="form-control" id="formGroupExampleInput" readonly placeholder="施設コード + カテゴリーコード(自動入力)">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">施設コード</label>
  <input require pattern="^\d{2}$" value="@if(isset($facility['facility_code'])){{ $facility['facility_code'] }}@endif" name="facility[facility_code]" type="text" class="form-control" id="formGroupExampleInput" placeholder="数字2桁（1桁の場合0埋め）">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">カテゴリーコード</label>
  <input require pattern="^\d{2}$" value="@if(isset($facility['category_code'])){{ $facility['category_code'] }}@endif" name="facility[category_code]" type="text" class="form-control" id="formGroupExampleInput" placeholder="数字2桁（1桁の場合0埋め）">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">UID</label>
  <input require value="@if(isset($facility['UID'])){{ $facility['UID'] }}@endif" name="facility[UID]" type="number" class="form-control" id="formGroupExampleInput" placeholder="数値を入力">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">名称</label>
  <input require value="@if(isset($facility['name'])){{ $facility['name'] }}@endif" name="facility[name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">名称（ｶﾅ）</label>
  <input pattern="^[ｦ-ﾝ()\s\d]+$" value="@if(isset($facility['name_furi'])){{ $facility['name_furi'] }}@endif" name="facility[name_furi]" type="text" class="form-control" id="formGroupExampleInput" placeholder="半角カナ・数字・スペースで入力">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">概要</label>
  <input value="@if(isset($facility['description'])){{ $facility['description'] }}@endif" name="facility[description]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">イチ押し・名称</label>
  <input value="@if(isset($facility['recommendation_name'])){{ $facility['recommendation_name'] }}@endif" name="facility[recommendation_name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">イチ押し・説明</label>
  <input value="@if(isset($facility['recommendation_desc'])){{ $facility['recommendation_desc'] }}@endif" name="facility[recommendation_desc]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間_開始（1）</label>
  <input value="@if(isset($businesshours[0]['start_time'])){{ $businesshours[0]['start_time'] }}@endif" name="business_info[0][start_time]" type="time" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間_終了（1）</label>
  <input value="@if(isset($businesshours[0]['end_time'])){{ $businesshours[0]['end_time'] }}@endif" name="business_info[0][end_time]" type="time" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間（1_補足）</label>
  <input value="@if(isset($businesshours[0]['time_supplement'])){{ $businesshours[0]['time_supplement'] }}@endif" name="business_info[0][time_supplement]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間_開始（2）</label>
  <input value="@if(isset($businesshours[1]['start_time'])){{ $businesshours[1]['start_time'] }}@endif" name="business_info[1][start_time]" type="time" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間_終了（2）</label>
  <input value="@if(isset($businesshours[1]['end_time'])){{ $businesshours[1]['end_time'] }}@endif" name="business_info[1][end_time]" type="time" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間（2_補足）</label>
  <input value="@if(isset($businesshours[1]['time_supplement'])){{ $businesshours[1]['time_supplement'] }}@endif" name="business_info[1][time_supplement]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間_開始（3）</label>
  <input value="@if(isset($businesshours[2]['start_time'])){{ $businesshours[2]['start_time'] }}@endif" name="business_info[2][start_time]" type="time" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間_終了（3）</label>
  <input value="@if(isset($businesshours[3]['end_time'])){{ $businesshours[3]['end_time'] }}@endif" name="business_info[2][end_time]" type="time" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">営業時間（3_補足）</label>
  <input value="@if(isset($businesshours[3]['time_supplement'])){{ $businesshours[3]['time_supplement'] }}@endif" name="business_info[2][time_supplement]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">チェックイン時間</label>
  <input value="@if(isset($facility['checkin_time'])){{ $facility['checkin_time'] }}@endif" name="facility[checkin_time]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">チェックアウト時間</label>
  <input value="@if(isset($facility['checkout_time'])){{ $facility['checkout_time'] }}@endif" name="facility[checkout_time]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">定休日（基本）</label>
  <input value="@if(isset($facility['regular_holiday'])){{ $facility['regular_holiday'] }}@endif" name="facility[regular_holiday]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">定休日（補足1）</label>
  <input value="@if(isset($facility['holiday_supplement1'])){{ $facility['holiday_supplement1'] }}@endif" name="facility[holiday_supplement1]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">定休日（補足2）</label>
  <input value="@if(isset($facility['holiday_supplement2'])){{ $facility['holiday_supplement2'] }}@endif" name="facility[holiday_supplement2]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">電話番号・問い合わせ先</label>
  <input value="@if(isset($facility['tel'])){{ $facility['tel'] }}@endif" name="facility[tel]" type="text" class="form-control" id="formGroupExampleInput" placeholder="複数入力可">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">電話番号（補足）</label>
  <input value="@if(isset($facility['tel_supplement'])){{ $facility['tel_supplement'] }}@endif" name="facility[tel_supplement]" name="facility[tel_supplement]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">場所</label>
  <input value="@if(isset($facility['place'])){{ $facility['place'] }}@endif" name="facility[place]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">料金</label>
  <input value="@if(isset($facility['price'])){{ $facility['price'] }}@endif" name="facility[price]" type="text" class="form-control" id="formGroupExampleInput" placeholder="複数入力可">
</div>
<div class="form-group">
  <label for="formGroupExampleInput">詳細（外部リンク）</label>
  <input value="@if(isset($facility['detail_link'])){{ $facility['detail_link'] }}@endif" name="facility[detail_link]" type="text" class="form-control" id="formGroupExampleInput">
</div>
<div class="form-check m-2 pl-0">
  <label class="form-check-label" for="is_closed">休業中</label>
  <input name="facility[is_closed]" class="form-check-input mx-2" type="checkbox" value="1" id="is_closed" @if(!empty($facility['is_closed'])) checked @endif>
</div>
<div class="form-group">
  <label for="formGroupExampleInput">施設備考</label>
  <input value="@if(isset($facility['remarks'])){{ $facility['remarks'] }}@endif" name="facility[remarks]" type="text" class="form-control" id="formGroupExampleInput">
</div>

<script type="text/javascript">
  function inputFCCode(){
    let facility_code = document.querySelector('input[name="facility[facility_code]"]').value;
    let category_code = document.querySelector('input[name="facility[category_code]"]').value;

    document.querySelector('input[name="facility[facility_category_code]"]').value=facility_code + category_code;
  }
  
  let facility_code = document.querySelector('input[name="facility[facility_code]"]');
  let category_code = document.querySelector('input[name="facility[category_code]"]');
  facility_code.addEventListener('change',function(e){
    inputFCCode();
  })
  category_code.addEventListener('change',function(e){
    inputFCCode();
  })
</script>