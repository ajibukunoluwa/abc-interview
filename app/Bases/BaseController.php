<?php

namespace App\Bases;
use App\Views\BaseView;

abstract class BaseController 
{

    protected $view;

    public function view(string $filename, array $params)
    {
        return (new BaseView())->render($filename, $params);
    }

}