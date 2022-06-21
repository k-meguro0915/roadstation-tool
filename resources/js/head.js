// ヘッダー構成部分におけるjavasctriptの挙動
function activateNavBar(){
  let uri = location.pathname;
  uri = uri.substring(1)
  let id;
  id = uri ? '#' + uri : '#route';
  document.querySelector(id).classList.add("active");
}

// main
window.onload= function(){
  activateNavBar();
}