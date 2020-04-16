<?php

namespace App\Models;

use App\Models\Product;
use App\Routes\Request;
use App\Bases\BaseModel;

class Rating extends BaseModel 
{

    private $user_id;
    private $product_id;
    private $lowestRating = 0;
    private $highestRating = 5;
    
    protected $product;
    protected $request;
    protected $table = "ratings";

    public function __construct()
    {
        parent::__construct();
        $this->product = new Product();
        $this->request = new Request();
    }

    public function middleware(int $user_id, int $product_id, float $value)
    {
        if($this->alreadyRated($user_id, $product_id))
        {
            return $this->request->sendJson([], "You already rated this product before", 403);
        }
        elseif($value < $this->lowestRating || $value > $this->highestRating)
        {
            return $this->request->sendJson([], "Your rating is below or above the limit, stop lurking around", 405);
        }
                
    }

    public function alreadyRated(int $user_id, int $product_id) : bool
    {
        $rating = $this->getWhere([
            "product_id" => $product_id,
            "user_id" => $user_id,
        ]);

        return (empty($rating)) ? false : true;
    }

    public function add(int $user_id, int $product_id, float $value) : int
    {
        return $this->insert(
        [
            "value"   => $value,
            "user_id"   => $user_id,
            "product_id"   => $product_id,
        ]);
    }

    public function average(int $product_id, float $value) : int
    {
        $product = $this->product->getDetail($product_id);
        $new_rating = ($product['average_rating'] == 0.0) ? $value : ($product['average_rating'] + $value) / 2;
        return $this->product->updateWhere(
        [
            "average_rating" => $new_rating
        ],
        [
            "id" => $product_id
        ]);
    }

}