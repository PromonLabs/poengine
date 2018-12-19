<template>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Process
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Process</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12 col-md-12" style="margin-top:20px;">
               <process-datatable></process-datatable>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">

        </div>
    </section>
    <!-- /.content -->
  </div>
</template>
<script>
    export default {}
</script>
<style>
    #circle {
        width: 50px;
        height: 50px;
        -webkit-border-radius: 25px;
        -moz-border-radius: 25px;
        border-radius: 25px;
        border: 2px solid #000;
        float:left;
        position: relative;
        top:35px;
    }
    #circle-line {
        border: 1px solid#000;
        float:left;
        width:20px;
        position: relative;
        top:40px;
    }
    #action-step {
        border: 1px solid#000;
        float:left;
        /* display:inline-block; */
        padding: 30px;
        text-align: center;
        width:auto;
        margin: 10px 0;
    }
    #show-flow {
        margin: 0 auto;
        display:table;
    }
</style>
