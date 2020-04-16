<?php

namespace App\Routes;

class Request 
{
    public function forceGetParams(array $keys)
    {
        $params = [];
        foreach($keys as $key)
        {
            if(!$_GET[$key])
            {
                $this->forceRedirect("page-not-found");
            }
            else 
            {
                $params[$key] = $_GET[$key];
            }
        }

        return $params;
    }

    public function forcePostParams(array $keys)
    {
        $params = [];
        // array_push($keys, "csrf_token");
        foreach($keys as $key)
        {
            if(!$_POST[$key])
            {
                $this->forceRedirect("page-not-found");
            }
            else 
            {
                $params[$key] = $_POST[$key];
            }
        }

        // $this->verifyCsrf();
        return $params;
    }

    public function verifyCsrf()
    {
        if($_SESSION['csrf_token'] !== $_POST['csrf_token'])
        {
            $this->sendJson([], "CSRF Token Validation failed", 401);
        }
    }

    public function sendJson(array $data = [], string $message = "", int $status = 200) : string
    {
        $encodedString = json_encode([
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ], true);

        http_response_code($status);
        $this->forceJson($encodedString);
    }


    public function forceJson(string $string) : void
    {
        header('Content-Type: application/json');
        echo $string;
        die();
    }

    public function forceRedirect(string $route = "")
    {
        $url = BASE_URL . $route;
        header("Location: $url");
        exit();
    }

    public function authMiddleware()
    {
        if(!(isset($_SESSION['loggedIn'])) || $_SESSION['loggedIn'] != true)
        {
            if($this->isAjax())
            {
                $this->sendJson([], "You have to be logged in to do that", 401);
            }
            
            $this->forceRedirect("login");
        }
    }

    private function isAjax()
    {
        if(
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
        ){
            return true;
        }

        return false;
    }
}
