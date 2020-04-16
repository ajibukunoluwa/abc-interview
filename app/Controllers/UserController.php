<?php

namespace App\Controllers;

use App\Models\User;
use App\Bases\BaseController;

class UserController extends BaseController
{

    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        dd('login ');
        echo " here we go again controller";
        // dd($this->user->getUser("chioma@list.com"));
        // dd($this->user->getWhere([
        //     "id" => 2,
        //     "email" => "chioma@list.com",
        // ]));
        // dd($this->user->deleteWhere([
        //     "email" => "iaskb@gmai.c",
        //     ]
        // ));
    }

}