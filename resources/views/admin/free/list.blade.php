<div class="box">
  <div class="box-header">

    <div class="col-md-12">

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <colgroup>
            {{--<col width="5%">--}}
            <col width="5%">
            <col width="30%">
            <col width="*">
            <col width="10%">
            <col width="7%">
            <col width="5%">
            <col width="5%">

          </colgroup>
          <thead>

          <tr>
            {{--<th class="text-center" style="vertical-align: middle"><input type="checkbox" id="allCheck"></th>--}}
            <th class="text-center">N O</th>
            <th class="text-center">제 목</th>
            <th class="text-center">내 용</th>
            <th class="text-center">작성자</th>
            <th class="text-center">등록일</th>
            <th class="text-center">상세</th>
            <th class="text-center">삭제</th>
          </tr>
          </thead>
          <tbody>

          @forelse($freeList as $key=>$free)
            <tr>
              {{--<td class="text-center"><input type="checkbox" name="check_list" value="24"></td>--}}
              <td class="text-center" style="vertical-align: middle">
                <p style="font-weight:bold">
                  {{ $free->id }}
                </p>
              </td>
              <td class="text-center" style="vertical-align: middle">{{ $free->title }}</td>
              <td style="vertical-align: middle">
                {!! $free->content !!}
              </td>
              <td class="text-center" style="vertical-align: middle">
                {{ \Encore\Admin\Auth\Database\Administrator::find($free->user_id)->name  }}
              </td>
              <td class="text-center" style="vertical-align: middle">{{ substr($free->created_at,0,10) }}</td>
              <td class="text-center" style="vertical-align: middle">
                <a href="/admin/free/{{$free->id}}" class="btn btn-success btn-sm">보기</a>
              </td>
              <td class="text-center item__free" style="vertical-align: middle" data-id="{{$free->id }}">
                <button class="btn btn-danger btn-sm button__delete">삭제</button>
              </td>
            </tr>
          @empty

            <td colspan="8" class="text-center"><p>글이 없습니다.</p></td>
          @endforelse

          </tbody>
        </table>
      </div>


      @if($freeList->count())
        <div class="text-center">
          {!! $freeList->render() !!}
        </div>
      @endif

      <div class="text-right">
        <a href="/admin/free/create" class="btn btn-primary">등록하기</a>
      </div>


    </div>

  </div>
</div>
</div>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.button__delete').on('click', function (e) {
    var businessId = $(this).closest('.item__business').data('id');
    if (confirm('글을 삭제합니다.')) {
      $.ajax({
        type: 'DELETE',
        url: '/admin/free/' + businessId
      }).then(function () {
        window.location.href = '/admin/business';
      });
    }

  });

</script>
<style>
  th {
    background: #fafafa;
  }
</style>