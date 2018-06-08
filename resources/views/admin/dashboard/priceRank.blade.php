<div class="box">
  <div class="box-header">

    <h3 class="box-title">매출금 / 미수금</h3>

  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive no-padding">

    <div style="padding-left: 10px;" >
      @php
        if (isset($_REQUEST['month']) && $_REQUEST['month'] == 1) {
      @endphp
      <a class="btn btn-primary" href="/admin?month=1"
         role="button">
      @php
        } else if (isset($_REQUEST['month']) && $_REQUEST['month'] == 2) {
      @endphp
        <a class="btn btn-default" href="/admin?month=1"
           role="button">
      @php
        }else {
      @endphp
          <a class="btn btn-default" href="/admin?month=1"
             role="button">
      @php
        }
      @endphp

       <?=date('Y')?> 년 전체</a>

      @php
        if (isset($_REQUEST['month']) && $_REQUEST['month'] == 1) {
      @endphp
        <a class="btn btn-default" href="/admin?month=2"
        role="button">
      @php
        } else if (isset($_REQUEST['month']) && $_REQUEST['month'] == 2) {
      @endphp
        <a class="btn btn-primary" href="/admin?month=2"
        role="button">
      @php
        }else {
      @endphp
       <a class="btn btn-default" href="/admin?month=2"
       role="button">
      @php
        }
      @endphp

        이번달 </a>
    </div>
    <canvas id="bar-chart" width="800" height="450"></canvas>

  </div>

  <!-- /.box-body -->
</div>
@php
  $test = explode(',',$noUsersCollectPrice);
  $string = "";
  for ( $i=0 ; $i < count($test) ; $i++ ) {
      if ($string == "") {
        $string = str_replace(","," ",number_format($test[$i]));
      } else {
        $string .= "," . str_replace(","," ",number_format($test[$i]));
      }
  }

@endphp

<script>
  $(function () {

    //var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;

    var labelArray = "{{ $users }}";
    labelArray = labelArray.split(",");
    var collectPrice = [{{ $usersCollectPrice }}];
    var noCollectPrice = [{{ $noUsersCollectPrice }}];


    var barChartData = {
      labels: labelArray,
      datasets: [{
        label: '총매출금액',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: collectPrice,


      }, {
        label: '미수금액',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: noCollectPrice
      }]

    };
    //randomScalingFactor()


    new Chart(document.getElementById("bar-chart"), {
      type: 'bar',
      data: barChartData,
      options: {
        responsive: true,
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: '매출 통계'
        }
      }
    });
  });


  function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
  }

</script>