<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">View</h3>

          <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 10px">
              <a href="http://myblog.local:8000/admin/business" class="btn btn-sm btn-default"><i
                  class="fa fa-list"></i>&nbsp;목록</a>
            </div>

            @if( $currentUser->id === $business->user_id)
              <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="http://myblog.local:8000/admin/business/{{$business->id}}/edit" class="btn btn-sm btn-primary"><i
                    class="fa fa-edit"></i>&nbsp;수정</a>
              </div>
            @endif

            <div class="btn-group pull-right" style="margin-right: 10px">
              <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;뒤로가기</a>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="" method="post" accept-charset="UTF-8" class="form-horizontal" pjax-container>
          <div class="box-body">
            <div class="fields-group">

              <input type="hidden" name="user_id" value="6" class="user_id"/>
              <input type="hidden" name="rank" value="1" class="rank"/>

              <div class="form-group ">
                <label class="col-sm-2 control-label">제목</label>
                <div class="col-sm-8">
                  <div class="box box-solid box-default no-margin">
                    <!-- /.box-header -->
                    <div class="box-body">
                      {{ $business->title }}
                    </div><!-- /.box-body -->
                  </div>
                </div>
              </div>

              <div class="form-group ">
                <label class="col-sm-2 control-label">내용</label>
                <div class="col-sm-8">
                  <div class="box box-solid box-default no-margin">
                    <!-- /.box-header -->
                    <div class="box-body">
                      {!! $business->content !!}
                    </div><!-- /.box-body -->
                  </div>
                </div>
              </div>

              <div class="form-group ">
                <label class="col-sm-2 control-label">등록일</label>
                <div class="col-sm-8">
                  <div class="box box-solid box-default no-margin">
                    <!-- /.box-header -->
                    <div class="box-body">
                      {{ $business->created_at }}
                    </div><!-- /.box-body -->
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- /.box-body -->
        </form>
        <div class="box-footer">
          <div class="col-md-2">

          </div>
          <div class="col-md-8 container__comment" style="background: #f0f0f0;">

            @include('admin.comments.index')

          </div>
        </div>


      </div>
    </div>
  </div>

</section>

<style>


</style>