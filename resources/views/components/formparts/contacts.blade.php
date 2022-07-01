<div id="contacts" class="mt-5">
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先</label>
    <input value="@if(isset($contact['contact_address'])){{ $contact['contact_address'] }}@endif" type="text" name="contacts[contact_address]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先郵便番号</label>
    <input value="@if(isset($contact['postal_code'])){{ $contact['postal_code'] }}@endif" type="text" name="contacts[postal_code]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先住所</label>
    <input value="@if(isset($contact['address'])){{ $contact['address'] }}@endif" type="text" name="contacts[address]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先電話番号</label>
    <input value="@if(isset($contact['tel'])){{ $contact['tel'] }}@endif" type="text" name="contacts[tel]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先FAX番号</label>
    <input value="@if(isset($contact['fax'])){{ $contact['fax'] }}@endif" type="text" name="contacts[fax]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先担当者</label>
    <input value="@if(isset($contact['manager'])){{ $contact['manager'] }}@endif" type="text" name="contacts[manager]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先メルアド</label>
    <input value="@if(isset($contact['mail'])){{ $contact['mail'] }}@endif" type="text" name="contacts[mail]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">調査連絡先備考</label>
    <input value="@if(isset($contact['remarks'])){{ $contact['remarks'] }}@endif" type="text" name="contacts[remarks]" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
</div>