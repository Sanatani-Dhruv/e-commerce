<?php

$uri = trim("/name/{user}/{about}");
$uri = trim("/name/{user}/{about}/", '/') ?? '/';
$length = strlen($uri);
echo "LENGTH: $length";
$actual_uri = "/name/deadster/about";
echo "\nURL: $uri\n";
echo "Actual URL: $actual_uri\n";

$num_of_curly_start = substr_count($uri, '{');
$num_of_curly_end = substr_count($uri, '}');
echo "Number of {: " . $num_of_curly_start;
echo "\nNumber of }: " . $num_of_curly_end;


echo "\n";
// echo preg_replace('/\/home\/\{[a-z 0-9A-z]{0,60}\}\/about/', 'ho', $actual_uri);
// preg_match('/\/name\/\{[a-z 0-9A-z]{0,60}\}\/about/', $actual_uri, $output_array);
// print_r($output_array);
// echo "\n";

if ($num_of_curly_start == $num_of_curly_end && $num_of_curly_start != 0) {
	$cursor = 0;
	$newUri = '';
	for ($i = 0; $i < $num_of_curly_start; $i++) {
	// for ($i = 0; $i < 2; $i++) {
		echo "\n";

		$pos_of_start = strpos($uri, '{', $cursor);
		// echo "Start of Word: $pos_of_start \n";

		$pos_of_end = strpos($uri, '}', $pos_of_start);

		$startString = substr($uri, 0, $pos_of_end - 1);
		$remainString = substr($uri, $cursor, $pos_of_end - 1);

		$endString = substr($uri, $pos_of_end + 1);

		// echo "End of Word: $pos_of_end ";

		echo "\n";

		$var = substr($uri, $pos_of_start, $pos_of_end - $pos_of_start + 1);

		if ($i != 0) {
			$newUri = $startString . $var;
		} else {
			$newUri = $remainString . $var;
		}

		echo "New URI: $newUri";

		echo "\nBefore String: $startString";

		// echo "\nExtracted: $var";

		echo "\nExtracted: $var";

		echo "\nRest String: $endString\n\n";

		$cursor += $pos_of_end - $cursor;
		if ($cursor++ == $length) {
			$cursor == $length;
		}
		echo "\nCursor Position: $cursor";
		$re = '/(\{[a-zA-Z0-9 ]{1,50}})/m';
		$str = '/user/{id}/{game}';
		$regex = '/{(\w+)(:[^}]+)?}/';
		$Var = preg_filter($regex, $i, $str, 1);
		print_r($Var);
	}
} else {
	echo "Route not properly defined, Matching { not found";
}
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
//
//
// $re = '/(\{[a-zA-Z0-9 ]{1,50}})/m';
// $str = '/user/{id}/{game}';
// $Str = '/user/id/game';
// $subst = "name";
//
// $result = preg_replace($re, $subst, $str);
// $var = preg_grep($re, [$Str]);
//
// echo '^((?!'. $re . ').)*';
//
//
// print_r($var);
// echo "\n\nString: $str";
// echo "\nThe result of the substitution is ".$result;


$str = '/name/{user}/{id}';
$actulStr = '/name/dhruv/12';
$arr = [
	'dhruv',
	'12'
];
for ($i = 0; $i < 2; $i++) {
	$re = '/(\{[a-zA-Z0-9 ]{1,50}})/m';
	$Var = preg_filter($re, $arr[$i], $str, 1);
	echo "\n$Var\n";
	$str = $Var;
}

{
	// Transform route to regex pattern.
	$routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches) {
		return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
	}, $route);

	// Add the start and end delimiters.
	$routeRegex = '@^' . $routeRegex . '$@';

	// Check if the requested route matches the current route pattern.
	if (preg_match($routeRegex, $requestedRoute, $matches))
	{
		// Get all user requested path params values after removing the first matches.
		array_shift($matches);
		$routeParamsValues = $matches;

		// Find all route params names from route and save in $routeParamsNames
		$routeParamsNames = [];
		if (preg_match_all('/{(\w+)(:[^}]+)?}/', $route, $matches))
		{
			$routeParamsNames = $matches[1];
		}

		// Combine between route parameter names and user provided parameter values.
		$routeParams = array_combine($routeParamsNames, $routeParamsValues);

		return  $this->resolveAction($action, $routeParams);
	}
	return $this->abort('404 Page not found');
}
