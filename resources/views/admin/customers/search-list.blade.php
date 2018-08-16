@php
  if ( isset($_REQUEST['customerId']) ) {
@endphp
<input type="hidden" name="customerId" value="{{ isset($_REQUEST['customerId'])? $_REQUEST['customerId']:'' }}">
@php
  }
@endphp

<table class="table table-bordered">
  <colgroup>
    <col width="25%">
    <col width="25%">
    <col width="25%">
    <col width="*">
  </colgroup>
  <tbody>
  <tr>
    <th class="text-center" style="background-color: #f1f1f1">회사명</th>
    <td>
      <input type="text" class="form-control company" placeholder="회사명" name="company"
             value="{{ isset($_REQUEST['company'])? $_REQUEST['company']:'' }}">
    </td>
    <th class="text-center" style="background-color: #f1f1f1">영업담당자</th>
    <td>
      <input type="text" class="form-control manager" placeholder="담당자" name="manager"
             value="{{ isset($_REQUEST['manager'])? $_REQUEST['manager']:'' }}">
    </td>
  </tr>

  <tr>
    <th class="text-center" style="background-color: #f1f1f1">고객명</th>
    <td>
      <input type="text" class="form-control name" placeholder="고객명" name="name"
             value="{{ isset($_REQUEST['name'])? $_REQUEST['name']:'' }}">
    </td>
    <th class="text-center" style="background-color: #f1f1f1">휴대폰</th>
    <td>
      <input type="text" class="form-control phone_number" placeholder="휴대폰" name="phone_number"
             value="{{ isset($_REQUEST['phone_number'])? $_REQUEST['phone_number']:'' }}">
    </td>
  </tr>

  <tr>
    <th class="text-center" style="background-color: #f1f1f1">고객분류</th>
    <td>

      <div class="form-group">
        <div class="input-group-btn">
          <select name="categoryCustomer" class="form-control input-sm">
            @foreach($categoryCustomers as $categoryCustomer => $label)
              <option
                value="{{ $categoryCustomer }}" {{ \Request::get('categoryCustomer', 'all') == $categoryCustomer ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

    </td>
    <th class="text-center" style="background-color: #f1f1f1">등록일</th>
    <td>
      <div class="form-group">

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control" id="created_at_start" placeholder="등록일" name="created_at[start]"
                 value="{{ isset($_REQUEST['created_at']['start'])? $_REQUEST['created_at']['start']:'' }}">
          <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>
          <input type="text" class="form-control" id="created_at_end" placeholder="등록일" name="created_at[end]"
                 value="{{ isset($_REQUEST['created_at']['end'])? $_REQUEST['created_at']['end']:'' }}">
        </div>
      </div>
    </td>
  </tr>

  <tr>
    <th class="text-center" style="background-color: #f1f1f1">미수금</th>
    <td>
      <label for="noMoney">
        <input type="checkbox" placeholder="미수금" name="c37d58aef6485bbb1df41dcb739cade0" id="noMoney"
               value="ok" {{ isset($_REQUEST['c37d58aef6485bbb1df41dcb739cade0']) == 'ok'? 'checked':'' }}>
        <span style="padding-left:5px;">체크시 미수금이 있거나 등록되어 있는것만 검색됩니다.</span>
      </label>

    </td>

    <th class="text-center" style="background-color: #f1f1f1">주소(지역)</th>
    <td>
      <input type="text" class="form-control" placeholder="휴대폰" name="address1"
             value="{{ isset($_REQUEST['address1'])? $_REQUEST['address1']:'' }}">
    </td>
  </tr>

  <tr>
    <th class="text-center" style="background-color: #f1f1f1"> 업데이트 체크</th>
    <td colspan="3">
      <label for="orderCheck">
        <input type="checkbox" placeholder="미수금" name="orderCheck" id="orderCheck"
               value="ok" {{ isset($_REQUEST['orderCheck']) == 'ok'? 'checked':'' }}>
        <span style="padding-left:5px;">체크시 업데이트 늦은 순으로 정렬됩니다.</span>
      </label>
    </td>
  </tr>

  {{--<tr>--}}
  {{--<th class="text-center">성명</th>--}}
  {{--<td>--}}
  {{--<input type="text" class="form-control name" placeholder="성명" name="name" value="">--}}
  {{--</td>--}}
  {{--</tr>--}}



  {{--<tr>--}}
  {{--<th class="text-center">이메일</th>--}}
  {{--<td>--}}
  {{--<input type="text" class="form-control email" placeholder="이메일" name="email" value="">--}}
  {{--</td>--}}
  {{--</tr>--}}

  <tr>
    <td colspan="4" class="text-center">
      <button type="submit" class="btn btn-primary btn-sm">검색</button>&nbsp;
      <a href="/admin/customers" class="btn btn-default btn-sm">초기화</a>
    </td>
  </tr>
  </tbody>
</table>

<script>
  $(function () {
    $('#created_at_start').datetimepicker({"format": "YYYY-MM-DD HH:mm:ss", "locale": "en"});
    $('#created_at_end').datetimepicker({"format": "YYYY-MM-DD HH:mm:ss", "locale": "en", "useCurrent": false});
    $("#created_at_start").on("dp.change", function (e) {
      $('#created_at_end').data("DateTimePicker").minDate(e.date);
    });
    $("#created_at_end").on("dp.change", function (e) {
      $('#created_at_start').data("DateTimePicker").maxDate(e.date);
    });

    $('#noSales_created_at_start').datetimepicker({"format": "YYYY-MM-DD HH:mm:ss", "locale": "en"});
    $('#noSales_created_at_end').datetimepicker({"format": "YYYY-MM-DD HH:mm:ss", "locale": "en", "useCurrent": false});
    $("#noSales_created_at_start").on("dp.change", function (e) {
      $('#noSales_created_at_end').data("DateTimePicker").minDate(e.date);
    });
    $("#noSales_created_at_end").on("dp.change", function (e) {
      $('#noSales_created_at_start').data("DateTimePicker").maxDate(e.date);
    });

    $('#sales_created_at_start').datetimepicker({"format": "YYYY-MM-DD HH:mm:ss", "locale": "en"});
    $('#sales_created_at_end').datetimepicker({"format": "YYYY-MM-DD HH:mm:ss", "locale": "en", "useCurrent": false});
    $("#sales_created_at_start").on("dp.change", function (e) {
      $('#sales_created_at_end').data("DateTimePicker").minDate(e.date);
    });
    $("#sales_created_at_end").on("dp.change", function (e) {
      $('#sales_created_at_start').data("DateTimePicker").maxDate(e.date);
    });

    $('.grid-row-checkbox').iCheck({checkboxClass: 'icheckbox_minimal-blue'}).on('ifChanged', function () {
      if (this.checked) {
        $(this).closest('tr').css('background-color', '#ffffd5');
      } else {
        $(this).closest('tr').css('background-color', '');
      }
    });

    $(".sms-send").click(function (e) {
      e.preventDefault();

      const idx = $(this).data('id');
      const phone = $(this).data('phone').replace(/(\s*)/g, "");
      const title = '문자 발송';
      const status = "toolbar=no,directories=no,scrollbars=no,resizable=no,status=no,menubar=no,width=300, height=700, top=0,left=0";
      window.open("/admin/sms?idx=" + idx + "&phone=" + phone, title, status);

    });
  });
</script>

