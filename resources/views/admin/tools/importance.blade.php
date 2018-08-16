<div class="btn-group" data-toggle="buttons">
  @foreach($options as $option => $label)
    <label class="btn btn-default btn-sm {{ \Request::get('importance', 'all') == $option ? 'active' : '' }}">
      <input type="radio" class="importance" value="{{ $option }}">{{$label}}
    </label>
  @endforeach
</div>

<div class="btn-group" data-toggle="buttons">
  <button class="btn btn-sm btn-primary sms-send" data-id="" data-phone="">문자보내기</button>
</div>