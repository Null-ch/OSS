<?php

namespace App\Services\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Services\LogInterface;

class CartService
{
    /**
     * Model: Cart
     *
     * @var object
     */

    private $cart;

    /**
     * LogInterface implementation
     *
     * @var object
     */
    private $logger;

    /**
     * Model: CartProduct
     *
     * @var object
     */
    private $cartProduct;


    /**
     * Model: Product
     *
     * @var object
     */
    private $product;

    /**
     * Construct cart service
     *
     * @param Cart $cart
     * @param LogInterface $logger
     * @param CartProduct $cartProduct
     * @param Product $product
     * 
     */
    public function __construct(Cart $cart, LogInterface $logger, CartProduct $cartProduct, Product $product)
    {
        (object) $this->cart = $cart;
        (object) $this->logger = $logger;
        (object) $this->cartProduct = $cartProduct;
        (object) $this->product = $product;
    }

    /**
     * Get cart products
     *
     * 
     * @return array
     * 
     */
    public function getCartProducts(): array
    {
        try {
            $cart = $this->cart::where('order_id', null)
                ->where(function ($query) {
                    $query->where('user_id', auth()->user()->id)
                        ->orWhere('session', session()->getId());
                })
                ->first();

            if ($cart) {
                $products = $cart->products;
            }

            if ($products) {
                foreach ($products as $product) {
                    $product->images;
                }
                $response = [
                    'result' => true,
                    'cart' => $products,
                ];
            } else {
                $response = [
                    'result' => false,
                    'message' => 'Корзина пуста'
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting cart products: ' . $e->getMessage());
            $response = [
                'result' => false,
                'message' => 'Корзина пуста'
            ];
        }

        return $response;
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
            return $cart;
        } catch (\Exception $e) {
            $this->logger->error('Error when getting cart: ' . $e->getMessage());
            return null;
        }
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
     * @param array $data
     * 
     * @return bool
     * 
     */
    public function addProduct(array $data): array
    {
        $product = $this->product->find($data['id']);
        if ($product) {
            $cart = $this->getCart();
        } else {
            $resonse = [
                'result' => false,
                'message' => 'Попытка добавления несуществующего товара!',
            ];

            return $resonse;
        }

        if ($cart) {
            try {
                $this->cartProduct->create([
                    'cart_id' => $cart->id,
                    'product_id' => $data['id'],
                    'quantity' => $data['quantity'],
                ]);
                $resonse = [
                    'result' => true,
                    'message' => 'Товар успешно добавлен!',
                ];
            } catch (\Exception $e) {
                $this->logger->error('Error when  creating an entry in the cart_products table: ' . $e->getMessage());
                $resonse = [
                    'result' => false,
                    'message' => 'Ошибка при добавлении товара!',
                ];
            }
        } else {
            $cart = $this->createCart();
            if ($cart) {
                try {
                    $this->cartProduct->create([
                        'cart_id' => $cart->id,
                        'product_id' => $data['id'],
                        'quantity' => $data['quantity'],
                    ]);
                    $resonse = [
                        'result' => true,
                        'message' => 'Товар успешно добавлен!',
                    ];
                } catch (\Exception $e) {
                    $this->logger->error('Error when  creating an entry in the cart_products table: ' . $e->getMessage());
                    $resonse = [
                        'result' => false,
                        'message' => 'Ошибка при добавлении товара!',
                    ];
                }
            } else {
                $this->logger->error('Error when  creating a shopping cart');
                $resonse = [
                    'result' => false,
                    'message' => 'Ошибка при добавлении товара!',
                ];
            }
        }

        return $resonse;
    }

    /**
     * Update current product in the cart
     *
     * @param array $data
     * 
     * @return array
     * 
     */
    public function updateProduct(array $data): array
    {
        $product = $this->product->find($data['id']);

        if (!$product) {
            $response = [
                'result' => false,
                'message' => 'Товар не найден!',
            ];

            return $response;
        }

        $cart = $this->getCart();

        if (!$cart) {
            $this->logger->error('Ошибка при создании корзины');
            $response = [
                'result' => false,
                'message' => 'Ошибка при обновлении товара!',
            ];

            return $response;
        }

        try {
            $cartProduct = $this->cartProduct::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            if ($cartProduct) {
                $cartProduct->quantity = $data['quantity'];
                $cartProduct->save();

                $response = [
                    'result' => true,
                    'message' => 'Товар успешно обновлен!',
                ];

                return $response;
            }
        } catch (\Exception $e) {
            $this->logger->error('Ошибка при создании записи в таблице cart_products: ' . $e->getMessage());
        }

        $response = [
            'result' => false,
            'message' => 'Ошибка при обновлении товара!',
        ];

        return $response;
    }

    /**
     * Removing an item from the shopping cart
     *
     * @param int $id
     * 
     * @return array
     * 
     */
    public function deleteProduct(int $id): array
    {
        try {
            $product = $this->product->findOrFail($id);
            $cart = $this->getCart();

            if ($cart && $product) {
                $cartProduct = $this->cartProduct::where('cart_id', $cart->id)
                    ->where('product_id', $product->id)
                    ->first();

                if ($cartProduct) {
                    $cartProduct->delete();
                    $response = [
                        'result' => true,
                        'message' => 'Товар удален из корзины!',
                    ];
                } else {
                    $response = [
                        'result' => false,
                        'message' => 'Товар не найден в корзине!',
                    ];
                }
            } else {
                $response = [
                    'result' => false,
                    'message' => 'Корзина не найдена!',
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error('Ошибка при удалении товара из корзины: ' . $e->getMessage());
            $response = [
                'result' => false,
                'message' => 'Ошибка при удалении товара из корзины!',
            ];
        }

        return $response;
    }
}
