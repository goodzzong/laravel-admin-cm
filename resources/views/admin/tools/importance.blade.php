<div class="btn-group" data-toggle="buttons">

  @foreach($options as $option => $label)
    <label class="btn btn-default btn-sm {{ \Request::get('importance', 'all') == $option ? 'active' : '' }}">
      <input type="radio" class="importance" value="{{ $option }}">{{$label}}
    </label>
  @endforeach


</div>
