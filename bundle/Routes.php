<?php
namespace Bundle;

use App\Router\Route;
use App\Controller\UserController;

$route = new Route();

// $route->get("/welcome", [
// 	UserController::class, "welcome", [
// 		"name" => "Dhruv",
// 		"id" => 11
// 	]
// ]);

$route->get("/", "main.php");

$route->get("/welcome", "welcome.php");

$route->get("/game/Alone/game", [
	UserController::class, "showDetail", [
		"name" => "Hi",
		"id" => 11
	]
]);

$route->end();
