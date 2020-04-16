<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Routes\Request;
use App\Bases\BaseController;

class CartController extends BaseController
{

    protected $cart;
    protected $table;
    protected $request;
    protected $authUser;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->order = new Order();
        $this->request = new Request();
        
        $this->request->authMiddleware();
    }

    public function add()
    {
        $postParams = $this->request->forcePostParams(['product_id', 'quantity']);
        extract($postParams);

        $this->cart->add($product_id, $quantity);
        
        return $this->request->sendJson([], "Added to cart", 201);
    }

    public function remove()
    {
        $postParams = $this->request->forcePostParams(['id']);
        extract($postParams);

        $this->cart->remove($id);
        return $this->request->sendJson([], "Removed from cart", 200);
    }

    public function viewCart()
    {
        $getsParams = $this->request->forceGetParams(['order_id']);
        extract($getsParams);

        $params = $this->cart->pendingCart($order_id);

        echo $this->view('pages/cart', $params);
    }


}