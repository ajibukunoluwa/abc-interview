<?php

namespace App\Controllers;

use App\Models\Rating;
use App\Models\Product;
use App\Routes\Request;
use App\Bases\BaseController;

class RatingController extends BaseController
{

    protected $table;
    protected $image;
    protected $rating;
    protected $product;
    protected $request;

    public function __construct()
    {
        $this->product = new Product();
        $this->request = new Request();
        $this->rating  = new Rating();
        $this->table   = $this->product->getTableName();

        $this->request->authMiddleware();
    }

    public function add()
    {
        
        $postParams = $this->request->forcePostParams(['product_id', 'value']);
        extract($postParams);

        $user_id = $_SESSION['user_id'];

        $this->rating->middleware($user_id, $product_id, $value);

        $addRating = $this->rating->add($user_id, $product_id, $value);
        $calculateAverageRating = $this->rating->average($product_id, $value);

        return $this->request->sendJson([], "Successfully rated", 201);

    }

}