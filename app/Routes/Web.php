<?php

namespace App\Routes;

require_once "includes/required_files.php";

use App\Routes\Router;
use App\Controllers\{
    AuthController,
    UserController,
    CartController,
    OrderController,
    RatingController,
    ProductController,
    StaticPageController,
};


/* Create a new router */
$router = new Router();
 

$router->addRoute('/', function(){
    (new ProductController())->index();
});

$router->addRoute('/page-not-found', function(){
    (new StaticPageController())->notFound();
});

$router->addRoute('/login', function(){
    (new AuthController())->login();
});
 

$router->addRoute('/register', function(){
    (new AuthController())->register();
});

$router->addRoute('/logout', function(){
    (new AuthController())->logout();
});
 

/* All product related routes */
$router->addRoute("/".PRODUCT_PREFIX, function(){
    (new ProductController())->detail();
});

$router->addRoute("/".PRODUCT_PREFIX."/add/rating", function(){
    (new RatingController())->add();
});


/* All cart related routes */
$router->addRoute("/".CART_PREFIX."/add", function(){
    (new CartController())->add();
});

$router->addRoute("/".CART_PREFIX."/remove", function(){
    (new CartController())->remove();
});

$router->addRoute("/".CART_PREFIX."/view", function(){
    (new CartController())->viewCart();
});

$router->addRoute("/".CART_PREFIX."/all", function(){
    (new OrderController())->allOrder();
});

$router->addRoute("/".CART_PREFIX."/checkout", function(){
    (new OrderController())->checkout();
});

$router->execute();