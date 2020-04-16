<?php

namespace App\Controllers;

use App\Models\Product;
use App\Routes\Request;
use App\Bases\BaseController;

class ProductController extends BaseController
{

    protected $table;
    protected $product;
    protected $request;

    public function __construct()
    {
        $this->product = new Product();
        $this->request = new Request();
        $this->table   = $this->product->getTableName();
    }

    public function index()
    {
        $params['products'] = $this->product->allWithImages();

        echo $this->view('pages/index', $params);
    }

    public function detail()
    {
        $getsParams = $this->request->forceGetParams(['product_id']);
        $id = $getsParams['product_id'];

        $params['product'] = $product = $this->product->detail($id);
        $params['images'] = $this->image->detail($product['id'], 'product_id');

        dd($params);

        return $params;
    }

}