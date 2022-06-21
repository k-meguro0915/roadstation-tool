<table class="table">
  <thead>
    <tr>
      @foreach($data->getAttributes() as $key=>$value)
        @if($key != 'CID' && $key != 'created_at' && $key != 'updated_at')
        <tr>
          <th class="col-md-3">{{$key}}</th>
          <th class="col-md-7 text-left">{{$value}}</th>
        </tr>
        @endif
      @endforeach
    </td>
  </thead>
</table>