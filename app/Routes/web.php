<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\AuthController;
use App\Controllers\OrderController;
use App\Controllers\SearchController;


use App\Controllers\Admin\HomeAdminController;
use App\Controllers\Admin\BookAdminController;
use App\Controllers\Admin\OrderAdminController;
use App\Controllers\CartController;
use App\Middleware\AdminMiddleware;


global $router;

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/contact', [HomeController::class, 'contact']);
$router->get('/activepage', [HomeController::class, 'activepage']);
$router->get('/forgotpassword', [HomeController::class, 'forgot_password']);
$router->get('/resetpassword', [HomeController::class, 'resetpassword']);
$router->post('/sendpasswordreset', [HomeController::class, 'sendpasswordreset']);
$router->post('/resetpassword', [HomeController::class, 'resetpassword']);

$router->get('/search', [SearchController::class, 'index']);


$router->get('/book/{id}', [HomeController::class, 'bookDetail']);

// cart
$router->get('/cart', [CartController::class, 'index']);
$router->post('/cart/add/{bookId}', [CartController::class, 'add']);
$router->post('/cart/remove/{bookId}', [CartController::class, 'remove']);
$router->post('/cart/updateQuantity/{bookId}/{quantity}', [CartController::class, 'updateQuantity']);
$router->post('/payment/checkout', [CartController::class, 'checkout']);

$router->get('/guest/checkout', [CartController::class, 'guestCheckoutForm']);

$router->get('/payment/success/{orderId}', [OrderController::class, 'orderSuccess']);
$router->get('/payment/fail/{orderId}', [OrderController::class, 'orderFail']);

$router->get('/order/search', [OrderController::class, 'searchOrder']);
$router->get('/order/track', [OrderController::class, 'trackOrder']);

$router->get('/sign-in', [AuthController::class, 'signIn']);
$router->post('/sign-in', [AuthController::class, 'signIn']);
$router->get('/sign-up', [AuthController::class, 'signUp']);
$router->post('/sign-up', [AuthController::class, 'signUp']);
$router->get('/logout', [AuthController::class, 'logout']);


// User profile routes
$router->get('/users/profile', [UserController::class, 'profile']);
$router->get('/users/updateProfile', [UserController::class, 'updateProfile']);
$router->post('/users/updateProfile', [UserController::class, 'updateProfile']);
$router->get('/users/orders', [OrderController::class, 'userOrders']);

$router->get('/admin', [HomeAdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/books', [BookAdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/books/add-book', [BookAdminController::class, 'add'], [AdminMiddleware::class]);
$router->post('/admin/books/add-book', [BookAdminController::class, 'add'], [AdminMiddleware::class]);
$router->post('/admin/books/delete/{id}', [BookAdminController::class, 'delete'], [AdminMiddleware::class]);


$router->get('/admin/orders/allOrders', [OrderAdminController::class, 'renderAllOrders']);
$router->get('/admin/orders/recent', [OrderAdminController::class, 'getRecentOrders']);
$router->get('/admin/orders?{orderId}', [OrderAdminController::class, 'getOrderDetails']);
