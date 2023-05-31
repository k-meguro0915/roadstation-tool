@extends('template')
@section('title','道の駅CSV登録')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <h2 class="mb-5">道の駅CSV登録</h2>
    <form action="/import_csv/confirm" method="POST" enctype="multipart/form-data">
			@csrf
      <div class="custom-file">
        <input type="file" name="file" class="custom-file-input" id="formFile">
        <label for="formFile" class="custom-file-label" data-browse="参照" required>ファイル選択...</label>
      </div>
      <div class="mt-5">
        <label>CSVの登録対象 ※道の駅か付帯設備かを選択</label>
        <select class="form-control custom-select" aria-label="Default select" name="type" required>
          <option value="">登録対象を選択</option>
          <option value="0">道の駅</option>
          <option value="1">付帯設備</option>
        </select>
      </div>
      <div class="form-group">
				<button id="submit" type="submit" class="btn btn-primary mb-2 mt-2">確定</button>
			</div>
      <input id="array-regist" type="hidden">
    </form>
    <div id="confirm-section">
      <div id="spinner" style="display:none" class="spinner-border text-primary" role="status">
      </div>
      <div id="confirm" style="display:none;">
        <p>先頭100件を表示</p>
        <table id="confirm-table" style="max-height: 600px;" class="table overflow-auto">
          <thead>
            <tr></tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
	</div>
@endsection
@section('script')
  <script type="text/javascript">
    let input = document.getElementById('formFile');
    let reader = new FileReader();
    let reader_object = "";
    let arr_csv,table_head,table_body;
    let _regist = [];
    function is_loading(boolval){
      if(boolval){
        console.log("start load");
        document.getElementById('spinner').style.display = 'block';
        document.getElementById('confirm-table').style.display = 'none';
      } else {
        console.log("end load");
        document.getElementById('spinner').style.display = 'none';
        document.getElementById('confirm-table').style.display = 'block';
      }
    }
    input.addEventListener('change', () => {
      is_loading(true);
      setTimeout(() => {
        for(file of input.files){
          //Fileオブジェクト(テキストファイル)のファイル内容を読み込む
          reader.readAsText(file, 'UTF-8');
          //ファイルの読み込み完了後に内容をコンソールに出力する
          reader.onload = ()=> {
            reader_object = reader.result;
            arr_csv = reader_object.split('\r\n');
            table_head = arr_csv[0].split(',');
            table_body = arr_csv.slice(1);
            let thead = document.querySelector('#confirm-table thead tr');
            let tbody = document.querySelector('#confirm-table tbody');
            table_head.forEach(el => {
              thead.innerHTML += '<th class="text-nowrap">'+ el + '</th>';
            })
            let arr_td;
            let dom;
            let cnt = 0;
            for(let i = 0; i < table_body.length; i++){
              arr_td = table_body[i].split(',');
              dom = '<tr>';
              _regist.push(arr_td);
              arr_td.forEach(item => {
                dom += '<td>'+ item +'</td>';
              })
              dom += '</tr>';
              tbody.innerHTML += dom;
            }
            document.getElementById('confirm').style.display = "block";
            is_loading(false);
          };
        }
      }, 1000);
    });
  </script>
@endsection