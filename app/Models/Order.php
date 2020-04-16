<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Routes\Request;
use App\Bases\BaseModel;

class Order extends BaseModel 
{

    private $id;
    private $status;
    private $total_cost;
    private $shipping_option;
    private $previous_balance;
    private $available_balance;
    
    protected $cart;
    protected $user;
    protected $orderId;
    protected $request;
    protected $table = "orders";

    public function __construct()
    {
        parent::__construct();
        $this->cart = new cart();
        $this->request = new Request();
    }

    public function add()
    {
        return $this->insert([
            "id" => $_SESSION['order_id']
        ]);
    }

    public function middleware(string $shippingOption, string $orderId)
    {
        $userId = $_SESSION['user_id'];
        $userBalance = $_SESSION['balance'];

        $this->validateShippingOption($shippingOption);

        $products = $this->allProduct($orderId, $userId);
        $totalCost = $this->totalCost($products['carts'], $shippingOption);
        $this->validateBalance($totalCost, $userBalance);

        return $totalCost;
    }

    public function allProduct(string $order_id, int $user_id) : array
    {
        return $this->cart->pendingCart($order_id, $user_id);
    }

    public function allOrder(string $orderId)
    {
        return $this->getWhere([
                "id" => $orderId,
                "user_id" => $_SESSION['user_id']
            ]);
    }

    public function placeOrder($totalCost, $shippingOption)
    {
        $availableBalance = $_SESSION['balance'] - $totalCost;

        // Update status to paid = done
        $this->updateWhere([
            "status" => "paid",
            "total_cost" => $totalCost,
            "shipping_option" => $shippingOption,
            "available_balance" => $availableBalance,
            "previous_balance" => $_SESSION['balance'],
        ], [
            "id" => $_SESSION['order_id']
        ]);

        
        // Update available balance on users table
        (new User)->updateAvailableBalance($availableBalance);

        // Generate new orderId
        $this->generateOrderId($_SESSION['user_id']);

    }

    private function validateShippingOption($option)
    {
        if(!in_array($option, ['pick_up', 'ups']))
        {
            return $this->request->sendJson([], "Ensure you select a shipping option", 403);
        }
    }

    private function validateBalance(float $totalCost, float $userBalance)
    {
        if($totalCost > $userBalance)
        {
            return $this->request->sendJson([], "Insufficient funds", 403);
        }
    }

    private function totalCost(array $products, string $shippingOption) : float
    {
        $total = 0;
        foreach ($products as $product) 
        {
            $total += ($product['price'] * $product['quantity']);
        }


        $total += ($shippingOption == "ups") ? 5 : 0;

        return $total;
    }

    public function generateOrderId(int $userId) : void
    {
        $pendingOrder = $this->getWhere([
            "user_id" => $userId,
            "status" => "pending",
        ]);

        (empty($pendingOrder)) ? $this->setOrderId($userId) : $_SESSION['order_id'] = $pendingOrder['id'];
    }

    private function setOrderId(int $userId) : void
    {
        $orderId = randomString();
        $_SESSION['order_id'] = $orderId;

        $pendingOrder = $this->insert([
            "id" => $orderId,
            "user_id" => $userId,
        ]);
    }

}