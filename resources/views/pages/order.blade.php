@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="custom-search-input">
                    <div class="input-group col-md-3">
                            {{-- <input type="text" id="search" list="order-ids" placeholder="Order Id"> --}}

                        <input type="search" class="form-control" list="order-ids"  name="search" id="search" placeholder="Search for order status"
                        value=""
                        autocomplete="off"
                        autofocus
                        spellcheck="false"
                        tabindex="0"
                        height="auto"
                        style = "height:40px;" />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit" id="search_bt" >
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                        <datalist id="order-ids"></datalist>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-12 col-md-12" style="margin-top:20px;">
                <div id="order-list"></div>
            </div>
        </div>
        <div class="loader" style="display:none; z-index:1000; position:absolute; top:30%; left:50%"></div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('style')
<style>
    .loader {
        margin:0 auto;
        z-index:1000;
        position:relative;
        top:20%;
        border: 10px solid #fff;
        border-radius: 50%;
        border-top: 10px solid #3498db;
        width: 80px;
        height: 80px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .content-wrapper {
        z-index:0;
    }
    .btn-lg {
      padding: 7px 16px !important;
    }
    .table {
        font-weight:normal !important;
    }
</style>
@endsection
@section('script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="/assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
{{-- <script src="/assets/lib/bootbox/bootbox.min.js" type="text/javascript"></script> --}}
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#search").keyup(function(){
            if ($("#search").val() !='') {
                axios.post('order/idlist',{ orderId: $("#search").val()}).then(response => {
                    $("#order-ids").html(response.data);
                }).catch(function (error) {
                    console.log(error);
                });

            } else {
                toShowOrders();
            }
        });
        $("#search_bt").click(function(){
            if ($("#search").val() !='') {
                $(".loader").css("display", "block");
                axios.post('order/list',{ orderId: $("#search").val()}).then(response => {
                    $("#order-list").html(response.data);
                    $(".loader").css("display", "none");
                }).catch(function (error) {
                    $(".loader").css("display", "none");
                    console.log(error);
                });
            } else {
                toShowOrders();
            }
        });


    });
    $(window).bind("load", function() {
        toShowOrders();
});
    function toShowOrders() {
        axios.get('order/orderlist').then(response => {
            $("#order-list").html(response.data);
            $(".loader").css("display", "none");
        }).catch(function (error) {
            $(".loader").css("display", "none");
            console.log(error);
        });
    }
</script>
@endsection
