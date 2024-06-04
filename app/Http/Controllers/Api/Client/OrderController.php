<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\Client\CartService;
use App\Services\Api\Client\OrderService;
use App\Http\Requests\Client\Cart\AddCartProductRequest;
use App\Http\Requests\Client\Cart\UpdateCartProductRequest;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Getting a list of products in the shopping cart
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

}
