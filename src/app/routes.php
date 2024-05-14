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

$router->addRoute('{controller}/{action}/{id:\d+}', [
    'controller' => 'Home',
    'action' => 'details'
]);
$router->addRoute('adminPromote', ['controller' => 'Admin', 'action' => 'users']);

// Routes in main controllers/ folder (Namespace \Controllers)
$router->addRoute('{controller}/{action}');
$router->addRoute('{controller}/{action}/{id:\d+}');
$router->addRoute('{controller}/{id:\d+}/{action}');


//$router->addRoute('WishList/{id:\d+}', ['controller' => 'WishList', 'action' => 'addToWishList']);

// Examples:
// 
// $router->addRoute('{controller}/{action}');
// $router->addRoute('{controller}/{action}/{id:\d+}');
// $router->addRoute('{controller}/{id:\d+}/{action}');

// Routes in folder controllers/folder1/ (Namespace \Controllers\Folder1)

// Examples:
// $router->addRoute('folder1/{controller}/{action}', ['namespace' => 'Folder1']);
// $router->addRoute('folder1/{controller}/{id:\d+}/{action}', ['namespace' => 'Folder1']);

// Routes in folder controllers/folder2/ (Namespace \Controllers\Folder2)

// Examples:
// $router->addRoute('folder2/{controller}/{action}', ['namespace' => 'Folder2']);
// $router->addRoute('folder2/{controller}/{id:\d+}/{action}', ['namespace' => 'Folder2']);

$router->setParams(getUri());
