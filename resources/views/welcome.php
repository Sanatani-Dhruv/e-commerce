<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<title><?=htmlspecialchars(getenv("APP_NAME") . " App")?></title>
	</head>
	<body>
	<h2>Welcome <?=(isset($name) ? ($name): '')?>!</h2>
		<p><a href="/">Home Page</a></p>
	</body>
</html>
