		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">

		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/manifest.json">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#13A89E">
		<meta name="theme-color" content="#ffffff">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title', 'ShaadiPlanner.co.uk')</title>
		<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/site.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">

		<script type="text/javascript" language="JavaScript" src="http://www.geoplugin.net/javascript.gp"></script>
		<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/jquery.mb.browser.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/jquery.mousewheel.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/jquery-html5-placeholder-shim.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/typeahead.bundle.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/icheck.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/jquery.blockUI.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/jquery.ui.touch-punch.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/common.js') }}"></script>
