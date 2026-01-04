<?php
require("../views/php/general-session-variable.php");

require __DIR__ . '/../vendor/autoload.php';
const VIEW_DIR = '../views';
require(VIEW_DIR . '/php/general-functions.php');

use Pierre\Router\Router;

$router = new Router();

$router->get('/', function () {
	require(VIEW_DIR . '/main.php');
});

$router->get('/user', function () {
	require(VIEW_DIR . '/user.php');
});

$router->get('/login', function () {
	require(VIEW_DIR . '/login.php');
});

$router->get('/signup', function () {
	require(VIEW_DIR . '/signup.php');
});

$router->run();
