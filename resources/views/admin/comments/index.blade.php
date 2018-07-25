<div class="page-header">
  <h4>
    댓글
  </h4>
</div>

<div class="form__new__comment">
  @if($currentUser)
    @include('admin.comments.partial.create')
  @else
    {{--@include('admin.comments.partial.login')--}}
  @endif
</div>

<div class="list__comment">
  @forelse($comments as $comment)
    @include('admin.comments.partial.comment', [
      'parentId' => $comment->id,
      'isReply' => false,
      'hasChild' => $comment->replies->count(),
      'isTrashed' => $comment->trashed(),
    ])
  @empty
  @endforelse
</div>

  <script>

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.btn__delete__comment').on('click', function (e) {

      var commentId = $(this).closest('.item__comment').data('id');

      if (confirm('댓글을 삭제합니다.')) {
        $.ajax({
          type: 'POST',
          url: "/admin/comments/" + commentId,
          data: {
            _method: "DELETE"
          }
        }).then(function () {
          $('#comment_' + commentId).fadeOut(1000, function () {
            $(this).remove();
          });
        });
      }

    });

    // 대댓글 폼을 토글한다.
    $('.btn__reply__comment').on('click', function (e) {

      var el__create = $(this).closest('.item__comment').find('.media__create__comment').first(),
        el__edit = $(this).closest('.item__comment').find('.media__edit__comment').first();
      el__edit.hide('fast');
      el__create.toggle('fast').end().find('textarea').focus();
    });
    // 댓글 수정 폼을 토글한다.
    $('.btn__edit__comment').on('click', function (e) {

      var el__create = $(this).closest('.item__comment').find('.media__create__comment').first(),
        el__edit = $(this).closest('.item__comment').find('.media__edit__comment').first();
      el__create.hide('fast');
      el__edit.toggle('fast').end().find('textarea').first().focus();
    });
  </script>
