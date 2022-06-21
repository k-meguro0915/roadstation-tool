/*-- 新規登録画面 -- */
// ボタンの色を切り替える
let cnt_accordion = 0;
window.changeIsService = function(id){
  let span = document.getElementById('service-btn-' + id);
  let checkbox = document.getElementById('service-checkbox-' + id);
  if(checkbox.checked){
    span.classList.remove('btn-secondary');
    span.classList.add('btn-primary');
  } else {
    span.classList.remove('btn-primary');
    span.classList.add('btn-secondary');
  }
}
//テンプレートを複製、または削除を行う判定
window.clickChangeButtonState = function(id,name){
  let span = document.getElementById('facility-btn-' + id);
  let checkbox = document.getElementById('facility-checkbox-' + id);
  if(checkbox.checked){
    span.classList.remove('btn-secondary');
    span.classList.add('btn-primary');
    showFacilitiesCard(id,name);
  } else {
    span.classList.remove('btn-primary');
    span.classList.add('btn-secondary');
    deleteFacilitiesCard(id);
  }
}
window.addFacilities = function(id,name){
  showFacilitiesCard(id,name);
}
// テンプレートを複製、DOMに表示する
window.showFacilitiesCard = function(id,name){
  cnt_accordion++;
  const ID = '0' + cnt_accordion;
  console.log(id);
  console.log(ID);
  let template = document.getElementById('tmp-facility-accordion');
  let firstClone = template.content.cloneNode(true);
  firstClone.getElementById('facility-accordion').innerHTML = firstClone.getElementById('facility-accordion').innerHTML.replace(/dom-alt/g,ID);
  firstClone.getElementById("facility-title").textContent="▼" + name + "(クリック・タップで開く)";
  firstClone.getElementById("facility-title").setAttribute('data-bs-target','#Collaps-' + ID);
  firstClone.getElementById("collapseOne").id = "Collaps-" + ID;
  firstClone.getElementById("facility-accordion").id = "facility-accordion-" + ID;
  firstClone.getElementById("facility-type").value = id;
  document.getElementById('facility-list').appendChild(firstClone);
  let card = document.getElementById('facility-accordion');
}
// テンプレートを削除する
window.deleteFacilitiesCard = function(id){
  const ID = '0' + id
  document.getElementById("facility-accordion-" + ID).remove();
}