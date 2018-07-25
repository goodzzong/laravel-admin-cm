<div class="box">
  <div class="box-header">

    <h3 class="box-title">사전영업등록게시판</h3>

  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tr>
        <th class="col-md-5">제목</th>
        <th class="col-md-5">내용</th>
        <th>등록일</th>

      </tr>

      @foreach($business as $busin)
        <tr>
          <td> <a href="{{ url('/admin/business/'.$busin->id) }}"> {{ str_limit(strip_tags($busin->title),50) }} </a></td>
          <td>{{ str_limit(strip_tags($busin->content),50) }}</td>
          <td>{{ substr($busin->created_at,0,10) }}</td>
        </tr>
      @endforeach



    </table>
  </div>

  <!-- /.box-body -->
</div>
