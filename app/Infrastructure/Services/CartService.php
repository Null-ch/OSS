<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Interfaces\CartInterface;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Infrastructure\Interfaces\LogInterface;

class CartService implements CartInterface
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
        (object) $this->cart = $cart;
        (object) $this->logger = $logger;
        (object) $this->product = $product;
        (object) $this->cartProductService = $cartProductService;
    }

    /**
     * Get cart products
     *
     * 
     * @return object
     * 
     */
    public function getCartProducts(): ?object
    {
        try {
            $cart = $this->getCart();

            if ($cart) {
                $products = $cart->products;
            }

            if ($products) {
                foreach ($products as $product) {
                    $product->images;
                }
            } else {
                return null;
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting cart products: ' . $e->getMessage());
            return null;
        }

        return $products;
    }

    /**
     * Get cart
     *
     * @return object
     * 
     */
    public function getCart(): ?object
    {
        try {
            $cart = $this->cart::where('order_id', null)
                ->where(function ($query) {
                    $query->where('user_id', auth()->user()->id)
                        ->orWhere('session', session()->getId());
                })
                ->first();
        } catch (\Exception $e) {
            $this->logger->error('Error when getting cart: ' . $e->getMessage());
            return null;
        }

        return $cart;
    }

    /**
     * Create new cart
     *
     * @return object
     * 
     */
    public function createCart(): object
    {
        return $this->cart->create();
    }

    /**
     * Adding a product to the shopping cart
     *
     * @param array $data Accepts the product id as input
     * 
     * @return string
     * 
     */
    public function addProduct(array $data): ?string
    {
        $product = $this->product->find($data['id']);
        if ($product) {
            $cart = $this->getCart();
        }

        if ($cart) {
            try {
                $this->cartProductService->createCartProduct([
                    'cart_id' => $cart->id,
                    'product_id' => $data['id'],
                    'quantity' => $data['quantity'],
                ]);
            } catch (\Exception $e) {
                $this->logger->error('Error when  creating an entry in the cart_products table: ' . $e->getMessage());
                return null;
            }
        } else {
            $cart = $this->createCart();
            if ($cart) {
                try {
                    $this->cartProductService->createCartProduct([
                        'cart_id' => $cart->id,
                        'product_id' => $data['id'],
                        'quantity' => $data['quantity'],
                    ]);
                } catch (\Exception $e) {
                    $this->logger->error('Error when  creating an entry in the cart_products table: ' . $e->getMessage());
                    return null;
                }
            } else {
                $this->logger->error('Error when  creating a shopping cart');
                return null;
            }
        }
    }

    /**
     * Update current product in the cart
     *
     * @param array $data Accepts the product ID and quantity as input
     * 
     * @return string
     * 
     */
    public function updateProduct(array $data): ?string
    {
        $product = $this->product->find($data['id']);

        if (!$product) {
            return null;
        }

        $cart = $this->getCart();

        if (!$cart) {
            $this->logger->error('Ошибка при создании корзины');
            return null;
        }

        try {
            $this->cartProductService->updateCartProduct($cart, $product, $data);
        } catch (\Exception $e) {
            $this->logger->error('Ошибка при создании записи в таблице cart_products: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Removing an item from the shopping cart
     *
     * @param int $id
     * 
     * @return string
     * 
     */
    public function deleteProduct(int $id): ?string
    {
        try {
            $product = $this->product->findOrFail($id);
            $cart = $this->getCart();

            if ($cart && $product) {
                $this->cartProductService->deleteCartProduct($cart, $product);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            $this->logger->error('Ошибка при удалении товара из корзины: ' . $e->getMessage());
            return null;
        }
    }
}
