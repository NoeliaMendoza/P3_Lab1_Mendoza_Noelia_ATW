<?php

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\LinkController;
use App\Controllers\PostController;
use App\Controllers\AuthController;
use App\Middleware\Authenticated;
use App\Middleware\Guest;

// Rutas públicas
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);

// Rutas de posts
$router->get('/post', [PostController::class, 'show']);

// Rutas de links/proyectos
$router->get('/links', [LinkController::class, 'index']);
$router->get('/links/create', [LinkController::class, 'create'], [Authenticated::class]);
$router->post('/links', [LinkController::class, 'store'], [Authenticated::class]);

// Rutas de productos - CRUD completo con middleware
$router->get('/products', [ProductController::class, 'index']);
$router->get('/products/create', [ProductController::class, 'create'], [Authenticated::class]);
$router->post('/products', [ProductController::class, 'store'], [Authenticated::class]);
$router->get('/products/edit', [ProductController::class, 'edit'], [Authenticated::class]);
$router->put('/products/update', [ProductController::class, 'update'], [Authenticated::class]);
$router->delete('/products/destroy', [ProductController::class, 'destroy'], [Authenticated::class]);

// Rutas de autenticación
$router->get('/login', [AuthController::class, 'loginForm'], [Guest::class]);
$router->post('/login', [AuthController::class, 'login'], [Guest::class]);
$router->post('/logout', [AuthController::class, 'logout'], [Authenticated::class]);