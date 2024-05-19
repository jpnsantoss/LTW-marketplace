<?php

// Static pages routes
$router->addRoute('', ['controller' => 'Home', 'action' => 'index']);
$router->addRoute('register', ['controller' => 'View', 'action' => 'register']);
$router->addRoute('login', ['controller' => 'View', 'action' => 'login']);
$router->addRoute('profile', ['controller' => 'View', 'action' => 'profile']);
$router->addRoute('create', ['controller' => 'View', 'action' => 'createProduct']);
$router->addRoute('cart', ['controller' => 'Cart', 'action' => 'index']);
$router->addRoute('wishlist', ['controller' => 'WishList', 'action' => 'index']);
$router->addRoute('profile', ['controller' => 'Admin', 'action' => 'profile']);
$router->addRoute('create', ['controller' => 'Admin', 'action' => 'additem']);;
$router->addRoute('chat', ['controller' => 'View', 'action' => 'chat']);
//$router->addRoute('checkout', ['controller' => 'Checkout', 'action' => 'index']);

//$router->addRoute('checkout', ['controller' => 'View', 'action' => 'checkout']);
$router->addRoute('checkout', ['controller' => 'Cart', 'action' => 'checkout']);
$router->addRoute('conclusion', ['controller' => 'Cart', 'action' => 'conclusion']);

$router->addRoute('admin', ['controller' => 'Admin', 'action' => 'index']);
$router->addRoute('adminUsers', ['controller' => 'Admin', 'action' => 'users']);

$router->addRoute('adminPromote', ['controller' => 'Admin', 'action' => 'users']);

$router->addRoute('inbox', ['controller' => 'Inbox', 'action' => 'index']);

$router->addRoute('{controller}/{action}');
$router->addRoute('{controller}/{action}/{id:\d+}');
$router->addRoute('{controller}/{id:\d+}/{action}');

$router->addRoute('api/{controller}/{action}', ['namespace' => 'Api']);
$router->addRoute('api/{controller}/{id:\d+}/{action}', ['namespace' => 'Api']);

$router->setParams(getUri());
