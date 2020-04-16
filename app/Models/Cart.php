<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Routes\Request;
use App\Bases\BaseModel;

class Cart extends BaseModel 
{

    private $user_id;
    private $order_id;
    private $quantity;
    private $product_id;
    
    protected $user;
    protected $request;
    protected $table = "carts";

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->request = new Request();
    }

    public function pendingCart(string $orderId) : array
    {
        $userId = $_SESSION['user_id'];
        $order = (new Order)->allOrder($orderId);

        $carts = $this->custom("SELECT * FROM `$this->table` as cart JOIN `products` as product ON product.id = cart.product_id 
        WHERE `order_id` = '$orderId'");

        return [
            "carts" => $carts,
            "order" => $order,
        ];
    }

    public function add(int $product_id, int $quantity) : int
    {
        $this->validateQuantity($quantity);
        return $this->insert([
            "product_id" => $product_id,
            "quantity" => $quantity,
            "order_id" => $_SESSION['order_id']
        ]);

    }

    public function remove(int $id)
    {
        return $this->deleteWhere([
            "id" => $id
        ]);
    }

    private function validateQuantity(int $quantity)
    {
        if($quantity <= 0)
        {
            return $this->request->sendJson([], "Quantity should be above zero", 401);
        }
    }

}