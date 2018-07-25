@if ($isTrashed and ! $hasChild)

@elseif ($isTrashed and $hasChild)



  <div class="media item__comment {{ $isReply ?  'sub' : 'top' }}" data-id="{{ $comment->id }}"
       id="comment_{{ $comment->id }}">
    <div>
      @include(' admin.users.partial.avatar', ['user' => $comment->user, 'size' => 32])
    </div>

    <div class="media-body">
      <h5 class="media-heading">
        <a href="">
          {{ $comment->user->name }}
        </a>
        <smail>
          {{ $comment->created_at->diffForHumans() }}
        </smail>
      </h5>

      <div class="text-danger content__comment" >
        삭제된 댓글입니다.
      </div>

      <div class="action_comment text-right">



        @if ($currentUser)
          <button class="btn__reply__comment btn btn-sm btn-twitter">답글 쓰기</buton>
        @endif
      </div>

      @if($currentUser)
        @include('admin.comments.partial.create', ['parentId' => $comment->id])
      @endif

      @if( $currentUser->id === $comment->user_id)
        @include('admin.comments.partial.edit')
      @endif

      @forelse($comment->replies as $reply)
        @include('admin.comments.partial.comment', [
          'comment' => $reply,
          'isReply' => true,
          'hasChild' => $reply->replies->count(),
          'isTrashed' => $reply->trashed(),
        ])
      @empty
      @endforelse

    </div>
  </div>

@else

  <div class="media item__comment {{ $isReply ?  'sub' : 'top' }}" data-id="{{ $comment->id }}"
       id="comment_{{ $comment->id }}">
    <div>
      @include(' admin.users.partial.avatar', ['user' => $comment->user, 'size' => 32])
    </div>

    <div class="media-body">
      <h5 class="media-heading">
        <a href="">
          {{ $comment->user->name }}
        </a>
        <smail>
          {{ $comment->created_at->diffForHumans() }}
        </smail>
      </h5>

      <div class="content__comment">
        {!! $comment->content !!}
      </div>

      <div class="action_comment text-right">

        @if( $currentUser->id === $comment->user_id)
          <button type="button" class="btn__delete__comment btn btn-danger btn-sm">댓글 삭제</button>
          <button type="button" class="btn__edit__comment btn btn-primary btn-sm">댓글 수정</button>
        @endif

        @if ($currentUser)
          <button class="btn__reply__comment btn btn-sm btn-twitter">답글 쓰기</buton>
        @endif
      </div>

      @if($currentUser)
        @include('admin.comments.partial.create', ['parentId' => $comment->id])
      @endif

      @if( $currentUser->id === $comment->user_id)
        @include('admin.comments.partial.edit')
      @endif

      @forelse($comment->replies as $reply)
        @include('admin.comments.partial.comment', [
          'comment' => $reply,
          'isReply' => true,
          'hasChild' => $reply->replies->count(),
          'isTrashed' => $reply->trashed(),
        ])
      @empty
      @endforelse

    </div>
  </div>

@endif

