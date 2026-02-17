<?php
namespace Bundle;

use App\Router\Route;
use App\Controller\UserController;

$route = new Route();

$route->get("/", "index.php");

$route->get('/products', 'product.php');

$route->get('/services', 'service.php');

$route->get('/contact', 'contact.php');

$route->get('/about', 'about.php');

$route->end();
