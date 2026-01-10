<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
	<title>About Us | {{ config('app.name') }}</title>
	<link rel="icon" href="images/logo-monodark.png">
	<link rel="stylesheet" href="css/header.css" media="all">
	<link rel="stylesheet" href="css/general.css" media="all">
	<link rel="stylesheet" href="css/view-page.css" media="all">
	<link rel="stylesheet" href="css/info-page.css" media="all">
	<link rel="stylesheet" href="css/footer-part.css" media="all">
</head>
<body id="body" class="body dark">
	{{ view('parts.header') }}
	<h1>About Page</h1>
	{{ view('parts.footer') }}
	<script src="/js/base.js"></script>
</body>
</html>
