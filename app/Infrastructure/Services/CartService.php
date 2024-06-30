<?php

namespace App\Infrastructure\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Infrastructure\Interfaces\LogInterface;

class CartService
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
     * Model: CartProduct
     *
     * @var object
     */
    protected $cartProduct;


    /**
     * Model: Product
     *
     * @var object
     */
    protected $product;

    /**
     * Construct cart service
     *
     * @param Cart $cart
     * @param LogInterface $logger
     * @param CartProduct $cartProduct
     * @param Product $product
     * 
     */
    protected function __construct(Cart $cart, LogInterface $logger, CartProduct $cartProduct, Product $product)
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
                $this->cartProduct->create([
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
                    $this->cartProduct->create([
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

        return 'Товар успешно добавлен';
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
            $cartProduct = $this->cartProduct::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            if ($cartProduct) {
                $cartProduct->quantity = $data['quantity'];
                $cartProduct->save();
            }
        } catch (\Exception $e) {
            $this->logger->error('Ошибка при создании записи в таблице cart_products: ' . $e->getMessage());
            return null;
        }

        return 'Корзина обновлена';
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
                $cartProduct = $this->cartProduct::where('cart_id', $cart->id)
                    ->where('product_id', $product->id)
                    ->first();

                if ($cartProduct) {
                    $cartProduct->delete();
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } catch (\Exception $e) {
            $this->logger->error('Ошибка при удалении товара из корзины: ' . $e->getMessage());
            return null;
        }

        return 'Товар удален из корзины!';
    }
}
