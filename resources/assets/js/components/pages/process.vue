<template>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" id="process-header">
      <h1>
        Process
      </h1>
      <ol class="breadcrumb">
        <li><router-link :to="'/api/home'"  exact>
                <i class="fa fa-dashboard"></i> Home
            </router-link></li>
        <li class="active">Process</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12" style="margin-top:20px;" id="process-default">
               <process-datatable></process-datatable>
            </div>
            <!-- /.col -->
        </div>
        <div class="col-xs-12 col-md-12" style="margin-top:20px;">
            <div id="process-details" style="margin-bottom: 100px;"></div>
        </div>
        <div class="loader" style="display:none; z-index:1000; position:absolute; top:60%; left:50%"></div>
    </section>
    <!-- /.content -->
    <div style="clear:both;"></div>
  </div>
</template>
<script>
    export default {

}
</script>
