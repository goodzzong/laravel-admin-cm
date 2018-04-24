<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#customerInfo{{ $customer->id }}"
         aria-controls="customerInfo{{ $customer->id }}" role="tab"
         data-toggle="tab">고객정보</a>
    </li>
    <li role="presentation">
      <a href="#sales{{ $customer->id }}" aria-controls="sales{{ $customer->id }}" role="tab"
         data-toggle="tab">매출정보</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="customerInfo{{ $customer->id }}"
         style="overflow-y: scroll; height:400px;">

      <form class="form-horizontal">

        <div class="form-group">
          <label class="col-sm-2 control-label">고객사 분류</label>
          <div class="col-sm-10">
            @if($category_customer)
              <p class="form-control-static">{{ $category_customer->title }}</p>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">영업분류</label>
          <div class="col-sm-10">
            @if($category_sales)
              <p class="form-control-static">{{ $category_sales->title }}</p>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">납품분류</label>
          <div class="col-sm-10">
            @if($category_delivery)
              <p class="form-control-static">{{ $category_delivery->title }}</p>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">영업담당자</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->manager }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">고객중요도</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->manager }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">회사</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->company }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">성명</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->name }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">직급</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->rank }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">대표전화</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->main_phone }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">휴대폰</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->phone_number }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">팩스</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->fax_number }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">이메일</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->email }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">주소 </label>
          <div class="col-sm-10">
            <p
              class="form-control-static">{{ "(".$customer->zipcode.") ".$customer->address1." ".$customer->address2 }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">특이사항</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $customer->contents }}</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">명함이미지</label>
          <div class="col-sm-10">
            @if($customer->picture)
              <p class="form-control-static">
                <img src="{{ url('/uploads/'.$customer->picture) }}"
                     style="max-width: 50%;">
              </p>
            @else
              <p class="form-control-static"> No Data.</p>
            @endif

          </div>
        </div>

        {{--<p class="form-control-static">{{ var_dump($customer->attach_files) }}</p>--}}

        {{--<div class="form-group">--}}
        {{--<label class="col-sm-2 control-label">첨부파일</label>--}}
        {{--<div class="col-sm-10">--}}
        {{--@if( count($customer->attach_files) >= 1 )--}}

        {{--@foreach( $customer->attach_files as $file)--}}
        {{--<p class="form-control-static">--}}
        {{--{{ $file }}--}}
        {{--</p>--}}
        {{--@endforeach--}}

        {{--@else--}}
        {{--<p class="form-control-static"> No Data.</p>--}}
        {{--@endif--}}

        {{--</div>--}}
        {{--</div>--}}


      </form>


    </div>
    <div role="tabpanel" class="tab-pane" id="sales{{ $customer->id }}">

      <div style="padding: 10px;">
        <table class="table table-bordered">
          <tr>
            <td style="background-color: #f1f1f1"></td>
            <td class="text-center" style="background-color: #f1f1f1">납품장소</td>
            <td class="text-center" style="background-color: #f1f1f1">매출발생일자</td>
            <td class="text-center" style="background-color: #f1f1f1">매출금액</td>
          </tr>

          @foreach( $sales as $key => $sale)
            <tr>
              <td class="text-center">{{ $key + 1 }}</td>
              <td class="text-center">{{ $sale->placeOfDelivery }}</td>
              <td class="text-center">{{ substr($sale->sales_at,0,10) }}</td>
              <td class="text-center">{{ number_format($sale->price) }} 원</td>
            </tr>
          @endforeach

          <tr>
            <td class="text-center" colspan="3" style="background-color: #f1f1f1">합계</td>
            <td class="text-center">{{ number_format($salesResultPrice) }} 원</td>
          </tr>

        </table>
      </div>
    </div>

  </div>

</div>
