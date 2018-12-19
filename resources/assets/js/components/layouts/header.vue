<template>
<header class="main-header">
    <!-- Logo -->
    <router-link :to="'/api/home'" class="logo" exact>
        <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>S</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PO Engine</b></span>
    </router-link>
 <!-- Header Navbar: style can be found in header.less -->
 <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
   <!--<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>-->
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <router-link :to="{name: 'dashboard'}" class="navbar-brand">Dashboard</router-link>
        <router-link :to="{name: 'order'}" class="navbar-brand">Order</router-link>
        <router-link :to="{name: 'process'}" class="navbar-brand">Process</router-link>
    </div>
    <ul class="nav navbar-nav"  style="float:right;">
        <li class="">
            <a href="/logout"><i class="glyphicon glyphicon-off"></i></a>
        </li>
    </ul>
  </nav>
</header>

</template>
<style>
.navbar {
    padding:0px !important;
    font-size:16px !important;
    justify-content: flex-end !important;
}
.navbar-brand {
    font-size:16px !important;
}
</style>
<script>
    export default {
        mounted() {
          //console.log('Component mounted.')
        }
    }
</script>
