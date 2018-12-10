@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Orders</span>
              <span class="info-box-number">{{ $orderCount }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file-text-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ongoing</span>
              <span class="info-box-number">{{ $processingOrderCount }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-file-text-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Completed</span>
              <span class="info-box-number">{{ $completedOrderCount }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Failed</span>
              <span class="info-box-number">{{ $failedOrderCount }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    <span class="panel-subtitle">Orders status</span>
                </div>
                <div class="panel-body">
                    <div id="order-donut" style="height: 250px;"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    <span class="panel-subtitle">Order Status for year wise</span>
                </div>
                <div class="panel-body">
                    <div id="order-status-year-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    <span class="panel-subtitle"><br>Orders for last {{ $ordersGroupByDay->count() }} days</span>
                </div>
                <div class="panel-body">
                    <div id="order-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    <span class="panel-subtitle"><br>Orders completed for last {{ $ordersCompletedGroupByDay->count() }} days</span>
                </div>
                <div class="panel-body">
                    <div id="order-completed-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    <span class="panel-subtitle">Orders completed for last {{ $ordersCompletedGroupByMonth->count() }} month</span>
                </div>
                <div class="panel-body">
                    <div id="order-status-month-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
<link rel="stylesheet" type="text/css" href="/assets/lib/morrisjs/morris.css"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="/assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/assets/lib/countup/countUp.min.js" type="text/javascript"></script>
<script src="/assets/lib/raphael/raphael-min.js" type="text/javascript"></script>
<script src="/assets/lib/morrisjs/morris.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        OrdersGroupByDay();
        OrdersCompletedGroupByDay();
        orderChart();
        OrdersStatusGroupByYear();
        OrdersCompletedGroupByMonth();
    });
    function OrdersGroupByDay() {
        var ordersGroupByDay = @json($ordersGroupByDay);
        new Morris.Line({
            element: 'order-chart',
            data: ordersGroupByDay,
            xkey: 'date',
            ykeys: ['orders'],
            labels: ['Orders'],
            lineColors: ['blue'],
        })
    }
    function OrdersCompletedGroupByDay() {
        var ordersCompletedGroupByDay = @json($ordersCompletedGroupByDay);
        new Morris.Line({
            element: 'order-completed-chart',
            data: ordersCompletedGroupByDay,
            xkey: 'date',
            ykeys: ['orders'],
            labels: ['Orders'],
            lineColors: ['blue'],
        })
    }
    function orderChart() {
        var orderStatus = @json($orderStatus);
        Morris.Donut({
            element: 'order-donut',
            data: orderStatus,
            //colors: [color1, color2, color3, color4],
            formatter: function (y) { return y },
        })
    }
    function OrdersStatusGroupByYear() {
        var ordersStatusGroupByYear = @json($ordersStatusGroupByYear);
        var bar = new Morris.Bar({
            element: 'order-status-year-chart',
            resize: true,
            data: ordersStatusGroupByYear,
            barColors: ['#00a65a', '#f56954', '#FFFF00', '#FFDAB9', '#FFEFD5', '#8FBC8F', '#CD5C5C'],
            xkey: 'date',
            ykeys: ['completedorders', 'failedorders', 'processingorders', 'waitingorders', 'pendingorders', 'completewithfailureorders', 'cancelled'],
            labels: ['Completed', 'Failed', 'Processing', 'Waiting', 'Pending', 'Complete with failures', 'Cancelled'],
            hideHover: 'auto',
            formatter: function (y) { return y },
        });
    }

    function OrdersCompletedGroupByMonth() {
        var ordersCompletedGroupByMonth = @json($ordersCompletedGroupByMonth);
        var bar = new Morris.Bar({
            element: 'order-status-month-chart',
            data: ordersCompletedGroupByMonth,
            xkey: 'date',
            ykeys: ['orders'],
            labels: ['Completed'],
            lineColors: ['blue'],
        });
    }
</script>

