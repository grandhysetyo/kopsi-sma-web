<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title> @yield('title')</title>
		<meta name="description" content="">
		<meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/font-awesome.min.css')}}">
        <script src="{{asset('superadmin/js/jquery.min.js')}}"></script>
        <script src="//parsleyjs.org/dist/parsley.js"></script> 

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-production.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-skins.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/demo.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <script src="{{ asset('js/select2.min.js') }}" defer></script>

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <style>
            .max-h-64 {
                max-height: 16rem;
            }
            /*Quick overrides of the form input as using the CDN version*/
            .form-input,
            .form-textarea,
            .form-select,
            .form-multiselect {
                background-color: #edf2f7;
            }
        </style>
        <style>
            input.parsley-success,
            select.parsley-success,
            textarea.parsley-success {
              color: #468847;
              background-color: #DFF0D8;
              border: 1px solid #D6E9C6;
            }
          
            input.parsley-error,
            select.parsley-error,
            textarea.parsley-error {
              color: #B94A48;
              background-color: #F2DEDE;
              border: 1px solid #EED3D7;
            }
          
            .parsley-errors-list {
              margin: 2px 0 3px;
              padding: 0;
              list-style-type: none;
              font-size: 0.9em;
              line-height: 0.9em;
              opacity: 0;
          
              transition: all .3s ease-in;
              -o-transition: all .3s ease-in;
              -moz-transition: all .3s ease-in;
              -webkit-transition: all .3s ease-in;
            }
          
            .parsley-errors-list.filled {
              opacity: 1;
            }
            
            .parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
             color:#ff0000;
            }
            
        </style>

	</head>
	<body id="login">
		@yield('content')
        @yield('script')
	</body>
</html>