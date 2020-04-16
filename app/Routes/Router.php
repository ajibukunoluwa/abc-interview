<?php

namespace App\Routes;

class Router 
{
 
    private $routes;
 
    function addRoute($route, callable $closure) 
    {
        $this->routes[$route] = $closure;
    }
 
    function execute() 
    {
        // $path = $_SERVER['PATH_INFO'];
        $path = explode("?", $_SERVER['REQUEST_URI']);
        $absolute_path = $path[0];
        
        if(array_key_exists($absolute_path, $this->routes)) {
            $this->routes[$absolute_path]();
        } else {
            $this->routes['/']();
        }
    }  
     
}
