<?php

namespace App\Controllers;

use App\Models\User;
use App\Routes\Request;
use App\Bases\BaseController;

class AuthController extends BaseController
{

    protected $user;
    protected $request;

    public function __construct()
    {
        $this->user = new User();
        $this->request = new Request();
    }

    public function register()
    {
        $postParams = $this->request->forcePostParams(['email', 'password']);
        extract($postParams);

        $this->user->registerMiddleware($email);
        $this->user->register($email, $password);
        $this->user->startSession($email);

    }

    public function login()
    {
        $postParams = $this->request->forcePostParams(['email', 'password']);
        extract($postParams);

        if(!$user = $this->user->userExists($email))
        {
            $this->request->sendJson([], "User not found", 404);
        } 

        if($this->user->verifyUserPassword($password, $user['password']))
        {
            $this->user->startSession($email, "logged in");
        }

        return $this->request->sendJson([], "Incorrect password", 422);
    }

    public function logout()
    {
        $postParams = $this->request->forcePostParams(['ensure_its_a_post_request']);
        extract($postParams);

        $this->user->endSession();
        $this->request->forceRedirect("");
    }

}