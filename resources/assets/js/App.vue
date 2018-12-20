<template>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<!-- Basic Page Needs -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>PO Engine - Dashboard</title>

		<meta name="keywords" content="PO Engine">
		<meta name="description" content="PO Engine">
        <meta name="csrf-token" content="{{csrf_token()}}">
		<!-- Favicon -->
		<link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        @yield('style')
	</head>
	<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-green-light">
		<div class="wrapper" id="app">

			<app-header></app-header>
      <router-view></router-view>
      <app-footer></app-footer>

      <div class="go-up">
          <a href="#"><i class="fa fa-chevron-up"></i></a>
      </div><!-- end go-up -->
    </div> <!-- end all -->

	</body>
</html>
</template>
<style>
    .content, .info-box-number, .info-box-number {
        font-weight:normal !important;
    }
</style>
@yield('script')