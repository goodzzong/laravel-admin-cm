<div class="box">
  <div class="box-header">

    <div class="col-md-12">
      {{--<div class="table-responsive">--}}

        {{--<form method="post" name="search_form" class="form-inline" action="">--}}
          {{--<input type="hidden" name="code" value="media1">--}}
          {{--<table class="table table-bordered">--}}
            {{--<colgroup>--}}
              {{--<col width="15%">--}}
              {{--<col width="*">--}}
            {{--</colgroup>--}}
            {{--<tbody>--}}
            {{--<tr>--}}
              {{--<th class="text-center">검색어</th>--}}
              {{--<td>--}}
                {{--<div class="form-group">--}}
                  {{--<div class="input-group-btn">--}}
                    {{--<select name="search_item" class="form-control input-sm">--}}
                      {{--<!-- <option value="">통합검색</option> -->--}}
                      {{--<option value="subject">제목</option>--}}
                      {{--<!-- <option value="content" >내용</option>--}}
                      {{--<option value="name" >작성자</option> -->--}}
                    {{--</select>--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<input type="text" name="search_order" class="form-control input-sm" value="">--}}
              {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
              {{--<th class="text-center">등록일</th>--}}
              {{--<td>--}}
                {{--<div class="input-group datetime">--}}
                  {{--<input type="text" name="search_sday" class="form-control input-sm text-center" value=""/>--}}
                  {{--<span class="input-group-addon">--}}
					          {{--<span class="glyphicon glyphicon-calendar"></span>--}}
				          {{--</span>--}}
                {{--</div>--}}
                {{--~--}}
                {{--<div class="input-group datetime">--}}
                  {{--<input type="text" name="search_eday" class="form-control input-sm text-center" value="2018-07-17"/>--}}
                  {{--<span class="input-group-addon">--}}
					          {{--<span class="glyphicon glyphicon-calendar"></span>--}}
				          {{--</span>--}}
                {{--</div>--}}
              {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
              {{--<th class="text-center">카테고리</th>--}}
              {{--<td>--}}
                {{--<label class="radio-inline"><input type="radio" name="search_cate" value="" checked>전체</label>--}}
                {{--<label class="radio-inline"><input type="radio" name="search_cate" value="1">국문</label>--}}
                {{--<label class="radio-inline"><input type="radio" name="search_cate" value="2">영문</label>--}}
              {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
              {{--<td colspan="2" class="text-center">--}}
                {{--<button type="submit" class="btn btn-primary btn-sm">검색</button>&nbsp;--}}
                {{--<a href="/admin/bbs/bbs_list.php?code=media1" class="btn btn-default btn-sm">초기화</a>--}}
              {{--</td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
          {{--</table>--}}
        {{--</form>--}}
      {{--</div>--}}

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

            @forelse($businessList as $key=>$business)
              <tr>
                {{--<td class="text-center"><input type="checkbox" name="check_list" value="24"></td>--}}
                <td class="text-center" style="vertical-align: middle">
                  <p style="font-weight:bold">
                    {{ $business->id }}
                  </p>
                </td>
                <td class="text-center" style="vertical-align: middle">{{ $business->title }}</td>
                <td style="vertical-align: middle">
                  {!! $business->content !!}
                </td>
                <td class="text-center" style="vertical-align: middle">
                  {{ \Encore\Admin\Auth\Database\Administrator::find($business->user_id)->name  }}
                </td>
                <td class="text-center" style="vertical-align: middle">{{ substr($business->created_at,0,10) }}</td>
                <td class="text-center" style="vertical-align: middle">
                  <a href="/admin/business/{{$business->id}}" class="btn btn-success btn-sm">보기</a>
                </td>
                <td class="text-center item__business" style="vertical-align: middle" data-id="{{$business->id }}" >
                  <button class="btn btn-danger btn-sm button__delete">삭제</button>
                </td>
              </tr>
            @empty

              <td colspan="8"><p>글이 없습니다.</p></td>
            @endforelse

            </tbody>
          </table>
        </div>


        @if($businessList->count())
          <div class="text-center">
            {!! $businessList->render() !!}
          </div>
        @endif

        <div class="text-right">
          <a href="/admin/business/create" class="btn btn-primary">등록하기</a>
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

  $('.button__delete').on('click',function(e){
    var businessId = $(this).closest('.item__business').data('id');
    if (confirm('글을 삭제합니다.')) {
      $.ajax({
        type : 'DELETE',
        url : '/admin/business/' + businessId
      }).then(function(){
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