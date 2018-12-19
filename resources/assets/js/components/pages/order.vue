<template>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
      </h1>
      <ol class="breadcrumb">
        <li>
            <router-link :to="'/api/home'" class="logo" exact>
                <i class="fa fa-dashboard"></i> Home
            </router-link>
        <li class="active">Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <order-datatable></order-datatable>
            </div>
            <!-- /.col -->
            <div class="col-xs-12 col-md-12" style="margin-top:20px;">
                <div id="order-flow"></div>
            </div>
        </div>
        <div class="loader" style="display:none; z-index:1000; position:absolute; top:30%; left:50%"></div>
    </section>
    <!-- /.content -->
  </div>
</template>
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
<script>
    export default {
       data () {
    return {
      search: ''
    }
  },
    mounted() {
        this.toShowOrders();
    },
    methods: {
        searchOnClick: function(event) {
            if (this.search != '') {
                $(".loader").css("display", "block");
                axios.post('/order/list', { orderId: this.search }).then(response => {
                    $("#order-list").html(response.data);
                    $(".loader").css("display", "none");
                }).catch(function(error) {
                    $(".loader").css("display", "none");
                    console.log(error);
                });
            } else {
                this.toShowOrders();
            }
        },
        toShowOrders: function() {
            axios.get('/order/orderlist').then(response => {
                $("#order-list").html(response.data);
                $(".loader").css("display", "none");
            }).catch(function(error) {
                $(".loader").css("display", "none");
                console.log(error);
            });
        },
        searchKeyUp: function() {
            if (this.search != '') {
                axios.post('/order/id/list', { orderId: this.search }).then(response => {
                    $("#order-ids").html(response.data);
                }).catch(function(error) {
                    console.log(error);
                });

            } else {
                this.toShowOrders();
            }
        }
    }
}
</script>
