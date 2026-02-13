<?php 

use Bundle\Bundler;

try {
	require __DIR__ . "/../bundle/Bundler.php";

	// Bundler class bundles your application with routes and other neccesary things
	$app = new Bundler();
	$app->bundle(); // Starting our app
} catch (Exception $err) {
	echo "<pre>$err</pre>";
}
