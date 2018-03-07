<div class="form-group  ">

  <label for="zipcode" class="col-sm-2 control-label">{{ $label }}</label>

  <div class="col-sm-2">

    <div class="input-group">


      <input {!! $attributes !!} type="text" id="{{$name}}" name="{{$name}}" value="{{ old($column, $value) }}"
             placeholder="{{$label}}"/>
      <span class="input-group-addon btn btn-primary" id="postcodify_search_button">
        검색
      </span>
    </div>


  </div>
</div>
