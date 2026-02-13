<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<title><?=out(env("APP_NAME") . " App")?></title>
	</head>
	<body>
		<h2>Welcome <?=(isset($name) ? ($name): '')?>!</h2>
		<p><a href="/">Home Page</a></p>
		<form action="/game/Alone/game" method="post">
			<input type="submit" value="Try to View Post Request Page by Clicking this Btn">
		</form>
	</body>
</html>
