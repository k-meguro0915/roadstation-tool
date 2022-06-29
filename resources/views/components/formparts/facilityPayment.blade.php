<div class="form-check pl-0">
  <label class="form-check-label" for="is_pay_to_credit">決済手段（クレジットカード）</label>
  <input name="payment[is_pay_to_credit]" class="form-check-input mx-2" type="checkbox" value="1" id="is_pay_to_credit" @if(!empty($payment['is_pay_to_credit'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="is_pay_to_e_money">決済手段（電子マネー）</label>
  <input name="payment[is_pay_to_e_money]" class="form-check-input mx-2" type="checkbox" value="1" id="is_pay_to_e_money" @if(!empty($payment['is_pay_to_e_money'])) checked @endif>
</div>
<div class="form-check pl-0">
  <label class="form-check-label" for="is_pay_to_barcode">決済手段（バーコード決済）</label>
  <input name="payment[is_pay_to_barcode]" class="form-check-input mx-2" type="checkbox" value="1" id="is_pay_to_barcode" @if(!empty($payment['is_pay_to_barcode'])) checked @endif>
</div>
<div class="form-group pl-0 my-2">
  <label for="formGroupExampleInput">決済手段（その他）</label>
  <input value="@if(isset($payment['is_pay_to_other'])){{ $payment['is_pay_to_other'] }}@endif" name="payment[is_pay_to_other]" type="text" class="form-control" id="formGroupExampleInput" placeholder="paypay等">
</div>