<?php
require(__DIR__ . "/../views/php/general-session-variable.php");
require __DIR__ . '/../vendor/autoload.php';

const VIEW_DIR = '../views';
require(VIEW_DIR . '/php/general-functions.php');

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', function() {
	require(VIEW_DIR . '/main.php');
});

SimpleRouter::get('/user', function () {
	require(VIEW_DIR . '/user.php');
});

SimpleRouter::post('/checkup', function () {
	require(VIEW_DIR . '/login.php');
	// return "Hello World";
});

SimpleRouter::get('/login', function () {
	require(VIEW_DIR . '/login.php');
});

SimpleRouter::get('/signup', function () {
	require(VIEW_DIR . '/register.php');
});

SimpleRouter::get('/product', function () {
	require(VIEW_DIR . '/product.php');
});

SimpleRouter::get('/service', function () {
	require(VIEW_DIR . '/services.php');
});

SimpleRouter::start();
