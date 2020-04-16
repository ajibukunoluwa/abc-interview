<?php

namespace App\Controllers;

use App\Bases\BaseController;

class StaticPageController extends BaseController
{

    public function notFound()
    {
        echo $this->view('pages/notFound', []);
    }

}