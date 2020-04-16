<?php

namespace App\Models;

use App\Bases\BaseModel;

class Image extends BaseModel 
{

    private $file_path;
    private $product_id;
    
    protected $table = "images";

    public function __construct()
    {
        parent::__construct();
    }

    public function detail($id, $column = 'id')
    {
        return $this->getDetail($id, $column);
    }

}