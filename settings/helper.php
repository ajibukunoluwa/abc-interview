<?php

if(!function_exists('dd'))
{
    function dd()
    {
        $args = func_get_args();

        foreach($args as $arg)
        {
            echo "<style>pre{color:#66FF00; background:#333; min-height:100vh}</style><pre>";
            var_dump($arg);
        }

        die();
    }
}


if(!function_exists('is_multidimensional_array'))
{
    function is_multidimensional_array(array $array) : bool
    {
        return (count($array) == count($array, COUNT_RECURSIVE)) ? false : true;
    }
}

if(!function_exists('randomString'))
{
    function randomString(int $length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if(!function_exists('killCookie'))
{
    function killCookie($cookieName) : void
    {
        if (isset($_COOKIE[$cookieName])) 
        {
            unset($_COOKIE[$cookieName]); 
            setcookie($cookieName, null, -1, '/'); 
        }
    }
}

if(!function_exists('setCookie'))
{
    function setCookie(string $cookieName, $cookieValue, int $days = 1) : void
    {
        setcookie($cookieName, $cookieValue, time() + (86400 * 30 * $days), "/");
    }
}

if(!function_exists('router'))
{
    function router(string $url, array $params = []) 
    {
        $count = 0;
        foreach($params as $key => $param)
        {
            $pattern = "$key=$param";
            $url.= ($count == 0) ? "?$pattern" : "&$pattern";
        }

        echo BASE_URL . $url;
    }
}

if(!function_exists('isLoggedIn'))
{
    function isLoggedIn() 
    {
        // dd($_SESSION);
        if((isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] === true))
        {
            return true;
        }

        return false;
    }
}