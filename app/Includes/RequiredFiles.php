<?php

namespace App\Includes;

class RequiredFiles 
{

    public function __construct()
    {
        require_once "constants.php";
        require_once BASE_PATH."vendor/autoload.php"; 
    }

}