<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>sysmate admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/dist/css/skins/skin-blue-light.min.css">

  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/plugins/iCheck/all.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/bootstrap-fileinput/css/fileinput.min.css?v=4.3.7">
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/plugins/select2/select2.min.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.skinNice.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css">

  <link rel="stylesheet" href="/css/comment.css">

  <meta name="csrf-token" content="IHAyB7PUkGkYaZ7z5SENeFrwnItf9pZrELVl6T0Y" ?
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/laravel-admin/laravel-admin.css">
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/nprogress/nprogress.css">
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/nestable/nestable.css">
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/toastr/build/toastr.min.css">
  <link rel="stylesheet"
        href="http://biz.sysmate.co.kr/vendor/laravel-admin/bootstrap3-editable/css/bootstrap-editable.css">
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/google-fonts/fonts.css">
  <link rel="stylesheet" href="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.min.css">

  <!-- REQUIRED JS SCRIPTS -->
  <script src="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
  <script
    src="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="http://biz.sysmate.co.kr/vendor/laravel-admin/AdminLTE/dist/js/app.min.js"></script>
  <script src="http://biz.sysmate.co.kr/vendor/laravel-admin/jquery-pjax/jquery.pjax.js"></script>
  <script src="http://biz.sysmate.co.kr/vendor/laravel-admin/nprogress/nprogress.js"></script>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="http://gsdemo799.giantsoft.co.kr/gsadmin/js/form.js"></script>
</head>

<body class="hold-transition skin-blue-light sidebar-mini sidebar-collapse">

<div class="col-md-12">

  <h3 class="page-header">문자 서비스</h3>

  <form method="post" action="{{ route('sms.store') }}" name="sms_form"><!-- cafe24 -->
  {!! csrf_field() !!}
  <!-- sms정보 -->
    <input type="hidden" name="action" value="go">
    <input type="hidden" name="smsType" value="">
    <!-- /sms정보 -->
    <input type="hidden" name="rphone" value=""><!-- 받는사람 -->


    <table class="table table-bordered">
      <colgroup>
        <col width="*%">
      </colgroup>
      <tbody>

      <tr>
        <th style="text-align:left">
          문자 내용 ( <span id="byteInfo"></span>
          byte )
        </th>
      </tr>
      <tr>
        <td>
          <textarea rows="12" class="form-control" name="messagebox"
                    onFocus="clearMessage(this.form);" onKeyUp="checkByte(this,'80');"></textarea><br>
          ※ 80byte 초과시 문자가 짤립니다.
        </td>
      </tr>

      <tr>
        <th style="text-align:left">받는사람 - 여러번호일 경우에는 ;으로 구분, 전화번호 구분자 대쉬(-)는 있거나 없거나 상관없음 (예 :
          01012345678;01012123434)
        </th>
      </tr>
      <tr>
        <td>
          <input type="text" name="receiveNumber" class="form-control">
        </td>
      </tr>

      {{--<tr>--}}
      {{--<th style="text-align:left">보내는사람</th>--}}
      {{--</tr>--}}
      {{--<tr>--}}
      {{--<td>--}}
      {{--<input type="text" name="sphone1" class="form-control2" size="3" >&nbsp;-&nbsp;--}}
      {{--<input type="text" name="sphone2" class="form-control2" size="4">&nbsp;-&nbsp;--}}
      {{--<input type="text" name="sphone3" class="form-control2" size="4">--}}
      {{--</td>--}}
      {{--</tr>--}}

      </tbody>
    </table>
  </form>

  <!-- 내용테이블 종료 -->

  <table class="table">
    <tr>
      <td class="text-center">
        <a href="javascript:sendit();" class="btn btn-primary">전송</a>
        <a href="javascript:self.close();" class="btn btn-default">닫기</a>
      </td>
    </tr>
  </table>

</div>

<script type="text/javascript">

  @php
    if ( isset($msg) ) {
  @endphp

    alert("{{ $msg }}");

  @php
    }
  @endphp
  /****************************
   * 바이트 처리
   ****************************/
  var clearChk = true;
  var limitByte = 80; //바이트의 최대크기, limitByte 를 초과할 수 없슴

  // textarea에 마우스가 클릭되었을때 초기 메시지를 클리어
  function clearMessage(frm) {

    if (clearChk) {
      document.sms_form.messagebox.value = "";
      clearChk = false;
    }

  }

  // textarea에 입력된 문자의 바이트 수를 체크
  function checkByte(obj,maxByte) {
    var str = obj.value;
    var str_len = str.length;

    var rbyte = 0;
    var rlen = 0;
    var one_char = "";
    var str2 = "";

    for(var i=0; i<str_len; i++){
      one_char = str.charAt(i);
      if(escape(one_char).length > 4){
        rbyte += 2;                                         //한글2Byte
      }else{
        rbyte++;                                            //영문 등 나머지 1Byte
      }

      if(rbyte <= maxByte){
        rlen = i+1;                                          //return할 문자열 갯수
      }
    }

    if(rbyte > maxByte){
      alert("한글 "+(maxByte/2)+"자 / 영문 "+maxByte+"자를 초과 입력할 수 없습니다.");
      str2 = str.substr(0,rlen);                                  //문자열 자르기
      obj.value = str2;
      checkByte(obj, maxByte);
    }else{
      document.getElementById('byteInfo').innerText = rbyte;
    }


  }

  function sendit() {

    var form = document.sms_form;

    if (form.messagebox.value == "") {
      alert("문자내용을 입력해주세요.");
      form.messagebox.focus();
    } else if (form.receiveNumber.value == "") {
      alert("받는 사람 전화번호를 입력해주세요.");
      form.receiveNumber.focus();
    } else {
      form.submit();
    }

  }
</script>


</body>
</html>

