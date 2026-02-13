<?php


$realUrl[] = '/game/dhruv/game';
$synUrl[] = '/game/{name}/{about}';

$i = 0;
foreach ($synUrl as $value) {
	echo "Synthetic Url: $value\n";
	$routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches) {
		return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
	}, $value);
	$routeRegex = '@^' . $routeRegex . '$@';
	echo "\n$routeRegex\n\n";

	if (preg_match($routeRegex, $realUrl[$i], $matches)) {
		print_r($matches);
	}
		$i++;
}
