<?php

namespace App\Services\Api\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Infrastructure\Services\CartService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\CartProductService;

class ClientCartService extends CartService
{
/**
     * Model: Cart
     *
     * @var object
     */

     protected $cart;

     /**
      * LogInterface implementation
      *
      * @var object
      */
     protected $logger;
 
     /**
      * Model: Product
      *
      * @var object
      */
     protected $product; 
 
     /**
      * cartProductService
      *
      * @var object
      */
     protected $cartProductService;
     
     /**
      * __construct
      *
      * @param  mixed $cart
      * @param  mixed $logger
      * @param  mixed $cartProduct
      * @param  mixed $product
      * @param  mixed $cartProductService
      */
     protected function __construct(Cart $cart, LogInterface $logger, Product $product, CartProductService $cartProductService)
    {
        parent::__construct($cart, $logger, $product, $cartProductService);
    }
}
