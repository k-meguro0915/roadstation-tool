<!-- 付帯施設情報アコーディオン -->
<template id="tmp-facility-accordion">
  <div id="facility-accordion" class="basic-information mt-3">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button
              id="facility-title"
              class="btn btn-link"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseOne"
              aria-expanded="true"
              aria-controls="collapseOne"
            >
            </button>
          </h5>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <input name="facility[dom-alt][facility_code]" id="facility-type" type="hidden">
            <div class="form-group">
              <label for="formGroupExampleInput">UID</label>
              <input name="facility[dom-alt][UID]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">施設名称</label>
              <input name="facility[dom-alt][name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">施設名称（フリガナ）</label>
              <input name="facility[dom-alt][name_furi]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">営業時間</label>
              <div class="row">
                <div class="col-auto">
                  <input name="facility[dom-alt][start_time1]" type="time" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="col-auto">
                  <span>～</span>
                </div>
                <div class="col-auto">
                  <input name="facility[dom-alt][end_time1]" type="time" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">営業時間（補足）</label>
              <input name="facility[dom-alt][time_supplement1]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">営業時間2</label>
              <div class="row">
                <div class="col-auto">
                  <input name="facility[dom-alt][start_time2]" type="time" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="col-auto">
                  <span>～</span>
                </div>
                <div class="col-auto">
                  <input name="facility[dom-alt][end_time2]" type="time" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">営業時間2（補足）</label>
              <input name="facility[dom-alt][time_supplement2]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">営業時間3</label>
              <div class="row">
                <div class="col-auto">
                  <input name="facility[dom-alt][start_time3]" type="time" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="col-auto">
                  <span>～</span>
                </div>
                <div class="col-auto">
                  <input name="facility[dom-alt][end_time3]" type="time" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">営業時間3（補足）</label>
              <input name="facility[dom-alt][time_supplement3]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">チェックイン時間</label>
              <input name="facility[dom-alt][checkin_time]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">チェックアウト時間</label>
              <input name="facility[dom-alt][checkout_time]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">定休日</label>
              <input name="facility[dom-alt][regular_holiday]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">定休日（補足1）</label>
              <input name="facility[dom-alt][holiday_supplement1]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">定休日（補足2）</label>
              <input name="facility[dom-alt][holiday_supplement2]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">電話番号・問い合わせ先</label>
              <input name="facility[dom-alt][tel]" type="tel" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">電話番号（補足）</label>
              <input name="facility[dom-alt][tel_supplement]" type="tel" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">料金</label>
              <input name="facility[dom-alt][price]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">詳細（外部リンク）</label>
              <input name="facility[dom-alt][detail_link]" type="url" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">イチ押し・名称</label>
              <input name="facility[dom-alt][recommendation_name]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">イチ押し・説明</label>
              <input name="facility[dom-alt][recommendation_desc]" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="is_closed-dom-alt">休業中</label>
              <input name="facility[dom-alt][is_closed]" type="checkbox" class="form-check-input" id="is_closed-dom-alt" value="1">
            </div>
            <h4 class="mt-5">決済方法</h4>
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="credit-dom-alt">クレジットカード</label>
              <input name="facility[dom-alt][is_pay_to_credit]" type="checkbox" class="form-check-input" id="credit-dom-alt" value="1">
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="e-money-dom-alt">電子マネー</label>
              <input name="facility[dom-alt][is_pay_to_e_money]" type="checkbox" class="form-check-input" id="e-money-dom-alt" value="1">
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="barcode-dom-alt">バーコード決済</label>
              <input name="facility[dom-alt][is_pay_to_barcode]" type="checkbox" class="form-check-input" id="barcode-dom-alt" value="1">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>