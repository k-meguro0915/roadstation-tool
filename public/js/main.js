/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*-- 新規登録画面 -- */
//テンプレートを複製、または削除を行う判定
window.clickChangeButtonState = function (id) {
  var span = document.getElementById('facility-btn-' + id);
  var checkbox = document.getElementById('facility-checkbox-' + id);

  if (checkbox.checked) {
    span.classList.remove('btn-secondary');
    span.classList.add('btn-primary');
    showFacilitiesCard(id);
  } else {
    span.classList.remove('btn-primary');
    span.classList.add('btn-secondary');
    deleteFacilitiesCard(id);
  }
}; // テンプレートを複製、DOMに表示する


window.showFacilitiesCard = function (id) {
  var template = document.getElementById('tmp-facility-accordion');
  var firstClone = template.content.cloneNode(true);
  firstClone.getElementById("facility-title").textContent = "▼売店(クリック・タップで開く)";
  firstClone.getElementById("facility-accordion").id = "facility-accordion-" + id;
  document.getElementById('facility-list').appendChild(firstClone);
  var card = document.getElementById('facility-accordion');
}; // テンプレートを削除する


window.deleteFacilitiesCard = function (id) {
  document.getElementById("facility-accordion-" + id).remove();
};
/******/ })()
;