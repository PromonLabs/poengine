<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<!-- Basic Page Needs -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>PO Engine - Dashboard</title>

		<meta name="keywords" content="PO Engine">
		<meta name="description" content="PO Engine">

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
        <style>
            .be-splash-screen {
                background-color: #eee;
            }
            .box {
                box-shadow:none;
            }
            .splash-container {
                max-width: 401px;
                margin: 50px auto;
            }
                .splash-container .card {
                    margin-bottom: 30px;
                }

                .card-border-color-primary {
                    border-top-color: #4285f4;
                }

                .card-border-color-primary {
                    border-top-color: #4285f4;
                }

                .card-border-color {
                    border-top: 3px solid #c9c9c9;
                    border-top-color: rgb(201, 201, 201);
                }

                .card {
                    background-color: #FFF;
                    margin-bottom: 25px;
                    box-shadow: 0 0 4px 0 rgba(0, 0, 0, .04);
                    border-width: 0;
                    border-top-width: 0px;
                    border-radius: 3px;
                    display: block;
                }

                .card {
                    position: relative;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-clip: border-box;
                    word-wrap: break-word;
                    border: 1px solid rgba(0, 0, 0, .125);
                    border-top-width: 1px;
                    border-right-width: 1px;
                    border-bottom-width: 1px;
                    border-left-width: 1px;
                    border-top-style: solid;
                    border-top-color: rgba(0, 0, 0, 0.125);
                }

                .splash-container .card .card-body {
                    padding: 20px 30px 15px;
                }

                splash-container .card .card-header {
                    text-align: center;
                    margin-bottom: 20px;
                    padding-top: 40px;
                    padding-bottom: 0;
                }

                .splash-description {
                    display: block;
                    line-height: 20px;
                    font-size: 1rem;
                    color: #5a5959;
                    margin-top: 11px;
                    padding-bottom: 10px;
                }

                .splash-description, .splash-footer, .splash-title {
                    text-align: center;
                }

                .card-header:first-child {
                    border-radius: calc(3px - 1px) calc(3px - 1px) 0 0;
                }

                .splash-container .card .card-header {
                    text-align: center;
                    margin-bottom: 20px;
                   /*  padding-top: 40px; */
                    padding-bottom: 0;
                }

                .card-header {
                    font-size: 18px;
                    font-weight: 300;
                    padding-left: 0;
                    padding-right: 0;
                    padding-top: 1.5384rem;
                    margin: 0 1.538rem;
                    margin-bottom: 0px;
                    border-bottom-width: 0;
                    border-radius: 3px 3px 0 0;
                    background-color: transparent;
                }

                .card-header {
                    border-bottom: 1px solid rgba(0, 0, 0, .125);
                    border-bottom-width: 1px;
                }

                .card-header, .card-text:last-child {
                    margin-bottom: 0;
                }

                .card-footer, .card-header {
                    padding: .7692rem 1.538rem;
                }

                .splash-container .card .card-body {
                    padding: 20px 30px 15px;
                }

                .card-body {
                    padding: 8px 20px 20px;
                    border-radius: 0 0 3px 3px;
                }

                .card-body {
                    -ms-flex: 1 1 auto;
                    flex: 1 1 auto;
                }
            </style>
	</head>
    <body class="be-splash-screen">
            <div class="be-wrapper be-login">
                <div class="be-content">
                    <div class="main-content container-fluid">
                        <div class="splash-container">
                            <div class="card card-border-color card-border-color-primary">
                                <div class="card-header">
                                    <div style="display: inline-flex; align-items: center;">
                                        <h3 style="margin-left: 10px;">PO Engine</h3>
                                    </div>
                                    <span class="splash-description">Please enter your user information.</span>
                                </div>
                                <div class="card-body">
                                    <div class="login-wrapper">
                                        <div class="box">
                                            <div class="content-wrap">
                                                <form class="form-horizontal" role="form" method="POST"
                                                      action="{{ url('/home') }}">
                                                    {!! csrf_field() !!}

                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                                        <div class="col-md-12">
                                                            <input type="email" class="form-control input-lg" name="email"
                                                                   value="{{ old('email') }}" placeholder="Email adresse">

                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <div class="col-md-12">
                                                            <input type="password" class="form-control input-lg" name="password"
                                                                   placeholder="Adgangskode">

                                                            @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="remember">
                                                        <label class="pull-right">
                                                            Remember me
                                                            <input type="checkbox" name="remember" checked>
                                                        </label>
                                                        <br>
                                                    </div>

                                                    <div class="action">
                                                        <button type="submit" class="btn btn-primary btn-xl">
                                                            Log ind
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
