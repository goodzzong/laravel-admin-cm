<div class="btn-group">
  <select class="customer-category">
    @foreach($options as $option => $label)

      @if ( !isset($category) && $option == 0)
        <option value="{{ $option }}"  selected >전체</option>
      @else
        <option value="{{ $option }}"  {{ \Request::get('category', 'all') == $option ? 'selected' : '' }}>{{ $label }}</option>
      @endif


    @endforeach
  </select>
</div>