<?php

namespace App\Models;

use App\Models\Image;
use App\Bases\BaseModel;

class Product extends BaseModel 
{

    private $name;
    private $image;
    private $price;
    private $description;
    private $average_rating;
    
    protected $table = "products";

    public function __construct()
    {
        $this->image = new Image();
        parent::__construct();
    }

    public function detail(int $id, string $column = 'id') : array
    {
        return $this->getDetail($id, $column);
    }

    public function allWithImages() : array
    {
        $productWithImages = [];
        foreach($this->all() as $product)
        {
            $images = $this->image->getWhere([
                'product_id' => $product['id']
            ]);

            array_push($productWithImages, [
                "detail" => $product,
                "images" => $images,
            ]);
        }

        return $productWithImages;
    }

}