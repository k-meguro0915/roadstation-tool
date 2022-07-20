
<!-- 基本情報アコーディオン -->
<div class="basic-information">
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="basic-information-header">
        <h5 class="mb-0">
          <button
            class="btn btn-link"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#information-accordion"
            aria-expanded="true"
            aria-controls="information-accordion"
          >
            ▼基本情報（クリック・タップで開く）
          </button>
        </h5>
      </div>
      <div 
        id="information-accordion" 
        class="collapse show" 
        aria-labelledby="basic-information-header" 
        data-parent="#accordionExample"
      >
        <div class="card-body">
          <div class="form-group">
            <label for="formGroupExampleInput">郵便番号</label>
            <input 
              value="@if(isset($address[0]->postal_code)){{ $address[0]->postal_code }}@endif"
              name="address[postal_code]"
              type="text"
              class="form-control"
              id="formGroupExampleInput"
              placeholder="ハイフン"
              pattern="^[\d-]+$"
            >
          </div>
          <div class="form-group">
            <label for="prefecture">住所（都道府県）</label>
            <select id="prefecture" type="text" class="form-control" name="address[prefecture]" onchange="setArea()">                          
              @foreach(config('prefecture') as $key => $score)
                <option 
                  value="{{ $score }}"
                  @if(isset($address[0]->prefecture) && $address[0]->prefecture == $score)
                    selected
                  @endif
                >
                  {{ $score }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">住所（市区町村以下）</label>
              <input value="@if(isset($address[0]->local_address)){{ $address[0]->local_address }}@endif" name="address[local_address]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">TEL</label>
            <input pattern="^[\d-]+$" value="@if(isset($address[0]->tel)){{ $address[0]->tel }}@endif" name="address[tel]" type="tel" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">住所コード</label>
            <input value="@if(isset($address[0]->address_code)){{ $address[0]->address_code }}@endif" name="address[address_code]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">マップコード</label>
            <input pattern="^\d{3} \d{3} \d{3}[*]\d{2}$" value="@if(isset($address[0]->map_code)){{ $address[0]->map_code }}@endif" name="address[map_code]" type="text" class="form-control" id="formGroupExampleInput" placeholder="記入例：180 277 270*55">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">経緯度（X）</label>
            <input pattern="^[\d.]+$" value="@if(isset($address[0]->latitude_x)){{ $address[0]->latitude_x }}@endif" name="address[latitude_x]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">経緯度（Y）</label>
            <input pattern="^[\d.]+$" value="@if(isset($address[0]->latitude_y)){{ $address[0]->latitude_y }}@endif" name="address[latitude_y]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">営業時間</label>
            <div class="row">
              <div class="col-auto">
                <input value="@if(isset($business_hour['start_time'])){{ $business_hour['start_time'] }}@endif" name="basic[start_time]" type="time" class="form-control" id="formGroupExampleInput">
              </div>
              <div class="col-auto">
                <span>～</span>
              </div>
              <div class="col-auto">
                <input value="@if(isset($business_hour['end_time'])){{ $business_hour['end_time'] }}@endif" name="basic[end_time]" type="time" class="form-control" id="formGroupExampleInput">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">休業日</label>
            <input value="@if(isset($roadstation['regular_holiday'])){{ $roadstation['regular_holiday'] }}@endif" name="basic[regular_holiday]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">駐車場台数（大型）</label>
            <input value="@if(isset($parking[0]->learge_parking_number)){{ $parking[0]->learge_parking_number }}@endif" name="parking[learge_parking_number]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">駐車場台数（普通車）</label>
            <input value="@if(isset($parking[0]->middle_parking_number)){{ $parking[0]->middle_parking_number }}@endif" name="parking[middle_parking_number]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">駐車場台数（障がい者用）</label>
            <input value="@if(isset($parking[0]->disabilities_parking_number)){{ $parking[0]->disabilities_parking_number }}@endif" name="parking[disabilities_parking_number]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">スタンプ設置場所1</label>
            <input value="@if(isset($stamp[0])){{ $stamp[0]->getAttributes()['installation_location'] }}@endif" name="stamp[0][installation_location]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">スタンプ営業時間1</label>
            <input value="@if(isset($stamp[0])){{ $stamp[0]->getAttributes()['start_time'] }}@endif" name="stamp[0][start_time]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">スタンプ設置場所2</label>
            <input value="@if(isset($stamp[1])){{ $stamp[1]->getAttributes()['installation_location'] }}@endif" name="stamp[1][installation_location]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">スタンプ営業時間2</label>
            <input value="@if(isset($stamp[1])){{ $stamp[1]->getAttributes()['start_time'] }}@endif" name="stamp[1][start_time]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">登録年</label>
            <input value="@if(isset($roadstation['registry_year'])){{ $roadstation['registry_year'] }}@endif" name="roadstation[registry_year]" type="year" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">Web</label>
            <input value="@if(isset($urls[0]->web)){{ $urls[0]->web }}@endif" name="urls[web]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">Twitter</label>
            <input value="@if(isset($urls[0]->twitter)){{ $urls[0]->twitter }}@endif" name="urls[twitter]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">Facebook</label>
            <input value="@if(isset($urls[0]->facebook)){{ $urls[0]->facebook }}@endif" name="urls[facebook]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">Instagram</label>
            <input value="@if(isset($urls[0]->instagram)){{ $urls[0]->instagram }}@endif" name="urls[instagram]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">その他</label>
            <input value="@if(isset($urls[0]->other)){{ $urls[0]->other }}@endif" name="urls[other]" type="text" class="form-control" id="formGroupExampleInput">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>