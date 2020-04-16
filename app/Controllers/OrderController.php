<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Routes\Request;
use App\Bases\BaseController;

class OrderController extends BaseController
{

    protected $table;
    protected $cart;
    protected $order;
    protected $product;
    protected $request;
    protected $authUser;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->order = new Order();
        $this->product = new Product();
        $this->request = new Request();
        $this->table   = $this->order->getTableName();
        
        $this->request->authMiddleware();
    }


    public function allOrder()
    {
        $userId = $_SESSION['user_id'];
        $params['orders'] = $this->order->custom("SELECT * FROM `$this->table` WHERE `user_id` = $userId");

        echo $this->view('pages/order', $params);
    }

    public function checkout()
    {
        $postParams = $this->request->forcePostParams(['order_id', 'shipping_option']);
        extract($postParams);

        $totalCost = $this->order->middleware($shipping_option, $order_id);

        $placeOrder = $this->order->placeOrder($totalCost, $shipping_option);
        return $this->request->sendJson([], "Order successfully paid for", 200);

    }

}