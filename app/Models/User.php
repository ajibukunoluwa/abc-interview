<?php

namespace App\Models;

use App\Models\Order;
use App\Routes\Request;
use App\Bases\BaseModel;

class User extends BaseModel 
{

    private $email;
    private $request;
    private $balance;
    private $password;
    private $created_at;
    
    protected $table = "users";

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
    }

    public function authUser() : array
    {
        $this->request->authMiddleware();
        // return $_SESSION['user'];
        return $_SESSION;
    }

    public function userExists(string $email)
    {
        $user = $this->getWhere([
            'email' => $email
        ]);

        return (empty($user)) ? false : $user;
    }

    public function registerMiddleware(string $email)
    {
        if($this->userExists($email))
        {
            $this->request->sendJson([], "Email $email already exists", 405);
        }
    }

    public function register(string $email, string $password) 
    {
        $hash = \password_hash($password, PASSWORD_DEFAULT);

        $this->insert([
            "email" => $email,
            "password" => $hash,
        ]);

    }

    public function verifyUserPassword(string $inputPassword, string $storedPassword)
    {
        return (\password_verify($inputPassword, $storedPassword)) ? true : false;
    }

    public function updateAvailableBalance(int $availableBalance) : void
    {
        $this->updateWhere(["balance" => $availableBalance],
            ["id" => $_SESSION['user_id']]);

        $_SESSION['balance'] = $availableBalance;
    }

    public function startSession($email, $type="registered")
    {

        $user = $this->getWhere([
            "email" => $email
        ]);

        (new Order())->generateOrderId($user['id']);

        $_SESSION['email'] = $email;
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['balance'] = $user['balance'];

        return $this->request->sendJson([], "Successfully $type", 201);
    }

    public function endSession()
    {
        $_SESSION = [];
        session_destroy();
    }

}