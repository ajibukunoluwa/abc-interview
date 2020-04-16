<?php

// Database related configurations
define('DB_DATABASE', "abc");
define('DB_USERNAME', "abcer");
define('DB_HOST', "172.31.0.2");
define('DB_PASSWORD', "ajimotiJohn");

// Routes prefixes
define('BASE_URL', "http://0.0.0.0:9090/");
// define('BASE_URL', $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);

define('API_PREFIX', "api");
define('CART_PREFIX', "cart");
define('PRODUCT_PREFIX', "product");

// Application basepath
define('BASE_PATH', realpath(dirname(__FILE__)) . "/");
define('CSRF_TOKEN', md5(uniqid(rand(), TRUE)));
$_SESSION['csrf_token'] = CSRF_TOKEN;




// Include custom helper functions
require_once BASE_PATH. "settings/helper.php";