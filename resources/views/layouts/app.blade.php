
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
		<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		 <!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
		<!-- Ionicons -->
		<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
        @yield('style')
	</head>
	<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-green-light">
		<div class="wrapper" id="app">

			<app-header></app-header>
			{{-- @include('layouts.sidebar') --}}
            @yield('content')
            <app-footer></app-footer>

            <div class="go-up">
                <a href="#"><i class="fa fa-chevron-up"></i></a>
            </div><!-- end go-up -->
        </div> <!-- end all -->
        <style>
            .content, .info-box-number, .info-box-number {
                font-weight:normal !important;
            }
        </style>
		<!-- jQuery 3 -->
		<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="{{ asset('assets/dist/js/pages/dashboard2.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
        <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('script')
	</body>
</html>
