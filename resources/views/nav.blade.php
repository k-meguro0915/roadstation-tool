@section('navigation')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">道の駅管理ツール</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li id="route" class="nav-item">
        <a class="nav-link" href="/">道の駅一覧 <span class="sr-only">(current)</span></a>
      </li>
      <li id="route" class="nav-item">
        <a class="nav-link" href="/facilities">付帯施設一覧 <span class="sr-only">(current)</span></a>
      </li>
      <!-- <li id="create_roadstation" class="nav-item">
        <a class="nav-link" href="/create_roadstation">道の駅新規登録</a>
      </li> -->
      <li id="import_csv" class="nav-item">
        <a class="nav-link" href="/import_csv">CSV取り込み</a>
      </li>
    </ul>
  </div>
</nav>
@endsection