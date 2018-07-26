@php

$modelUrl = $modelName == "business" ? "business.comments.store" : "free.comments.store";

@endphp
<div class="media media__create__comment {{ isset($parentId) ? 'sub' : 'top' }}">

  @include('admin.users.partial.avatar', ['user' => $currentUser, 'size' => 32])
  <div class="media-body">
    <form method="POST" action="{{ route($modelUrl, $model->id) }}" class="form-horizontal">
      {!! csrf_field() !!}

      @if(isset($parentId))
        <input type="hidden" name="parent_id" value="{{ $parentId }}">
      @endif
      <input type="hidden" name="modelName" value="{{ $modelName }}">

      <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
      </div>

      <div class="text-right">
        <button type="submit" class="btn btn-primary btn-sm">
          등록
        </button>
      </div>
    </form>
  </div>
</div>