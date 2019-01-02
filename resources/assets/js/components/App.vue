<template>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Needs -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Work Flow Engine - Dashboard</title>

		<meta name="keywords" content="PO Engine">
		<meta name="description" content="PO Engine">
		<!-- Favicon -->
		<link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		 <!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">
        @yield('style')
	</head>
	<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-green-light">
		<div class="wrapper" id="app">

			<app-header></app-header>
			<router-view></router-view>
			<app-footer></app-footer>

			<!-- <div class="go-up">
				<a href="#"><i class="fa fa-chevron-up"></i></a>
			</div> --><!-- end go-up -->
    </div> <!-- end all -->

	</body>
</html>
</template>
<style>
    .content, .info-box-number, .info-box-number {
        font-weight:normal !important;
    }
</style>
<script>
    export default {}
</script>

