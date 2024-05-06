<?php

// Static pages routes
$router->addRoute('', ['controller' => 'Home', 'action' => 'index']);
$router->addRoute('register', ['controller' => 'View', 'action' => 'register']);
$router->addRoute('login', ['controller' => 'View', 'action' => 'login']);
$router->addRoute('profile', ['controller' => 'Admin', 'action' => 'profile']);
$router->addRoute('create', ['controller' => 'Admin', 'action' => 'additem']);
$router->addRoute('cart', ['controller' => 'View', 'action' => 'cart']);
$router->addRoute('chat', ['controller' => 'View', 'action' => 'chat']);

$router->addRoute('admin', ['controller' => 'Admin', 'action' => 'index']);
$router->addRoute('adminPromote', ['controller' => 'Admin', 'action' => 'users']);

// Routes in main controllers/ folder (Namespace \Controllers)
$router->addRoute('{controller}/{action}');
$router->addRoute('{controller}/{action}/{id:\d+}');
$router->addRoute('{controller}/{id:\d+}/{action}');

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
