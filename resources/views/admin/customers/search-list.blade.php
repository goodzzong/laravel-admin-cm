<table class="table table-bordered">
  <colgroup>
    <col width="25%">
    <col width="15%">
    <col width="25%">
    <col width="*">
  </colgroup>
  <tbody>
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
    <th class="text-center" style="background-color: #f1f1f1">영업분류</th>
    <td>
      <div class="form-group">
        <div class="input-group-btn">
          <select name="categorySales" class="form-control input-sm">
            @foreach($categorySales as $categorySale => $label)
              <option
                value="{{ $categorySale }}" {{ \Request::get('categorySales', 'all') == $categorySale ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </td>
  </tr>


  <tr>
    <th class="text-center" style="background-color: #f1f1f1">납품분류</th>
    <td>
      <div class="form-group">
        <div class="input-group-btn">
          <select name="categoryDelivery" class="form-control input-sm">
            @foreach($categoryDeliverys as $categoryDelivery => $label)
              <option
                value="{{ $categoryDelivery }}" {{ \Request::get('categoryDelivery', 'all') == $categoryDelivery ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </td>
    <th class="text-center" style="background-color: #f1f1f1">회사명</th>
    <td>
      <input type="text" class="form-control company" placeholder="회사명" name="company" value="">
    </td>
  </tr>

  <tr>
    <th class="text-center" style="background-color: #f1f1f1">영업담당자</th>
    <td>
      <input type="text" class="form-control manager" placeholder="담당자" name="manager" value="{{ old('manager') }}">
    </td>
    <th class="text-center" style="background-color: #f1f1f1">등록일</th>
    <td>
      <div class="form-group">

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control" id="created_at_start" placeholder="등록일" name="created_at[start]"
                 value="">
          <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>
          <input type="text" class="form-control" id="created_at_end" placeholder="등록일" name="created_at[end]" value="">
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
    $('.grid-row-checkbox').iCheck({checkboxClass: 'icheckbox_minimal-blue'}).on('ifChanged', function () {
      if (this.checked) {
        $(this).closest('tr').css('background-color', '#ffffd5');
      } else {
        $(this).closest('tr').css('background-color', '');
      }
    });
  });
</script>