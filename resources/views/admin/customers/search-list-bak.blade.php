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
    <th class="text-center" style="background-color: #f1f1f1">미수금</th>
    <td>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control" id="noSales_created_at_start" placeholder="등록일"
                 name="noSales_created_at[start]"
                 value="{{ isset($_REQUEST['noSales_created_at']['start'])? $_REQUEST['noSales_created_at']['start']:'' }}">
          <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>
          <input type="text" class="form-control" id="noSales_created_at_end" placeholder="등록일"
                 name="noSales_created_at[end]"
                 value="{{ isset($_REQUEST['noSales_created_at']['end'])? $_REQUEST['noSales_created_at']['end']:'' }}">
        </div>
      </div>

    </td>
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
  </tr>

  <tr>
    <th class="text-center" style="background-color: #f1f1f1">매출금</th>
    <td>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control" id="sales_created_at_start" placeholder="등록일"
                 name="sales_created_at[start]"
                 value="{{ isset($_REQUEST['sales_created_at']['start'])? $_REQUEST['sales_created_at']['start']:'' }}">
          <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>
          <input type="text" class="form-control" id="sales_created_at_end" placeholder="등록일"
                 name="sales_created_at[end]"
                 value="{{ isset($_REQUEST['sales_created_at']['end'])? $_REQUEST['sales_created_at']['end']:'' }}">
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
  });
</script>

