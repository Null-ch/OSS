<?php

namespace App\Infrastructure\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\CartInterface;

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
     * productService
     *
     * @var object
     */
    protected $productService;


    /**
     * __construct
     *
     * @param  mixed $cart
     * @param  mixed $logger
     * @param  mixed $product
     * @param  mixed $cartProductService
     * @param  mixed $productService
     */
    protected function __construct(
        Cart $cart,
        LogInterface $logger,
        Product $product,
        CartProductService $cartProductService,
        ProductService $productService
    ) {
        $this->cart = $cart;
        $this->logger = $logger;
        $this->product = $product;
        $this->cartProductService = $cartProductService;
        $this->productService = $productService;
    }

    /**
     * Get cart
     *
     * @return object
     * 
     */
    public function getCart(): ?object
    {
        DB::beginTransaction();
        try {
            $userId = auth()->check() ? auth()->user()->id : null;
            $session = session()->has('id') ? session()->getId() : null;

            if ($userId) {
                $cart = $this->cart::where('user_id', $userId)->first();
            } elseif ($session) {
                $cart = $this->cart::where('session', $session)->first();
            }

            if ($cart) {
                $cart = $this->cart::where(function ($query) use ($cart) {
                    $query->whereNotNull('order_id')
                        ->whereHas('order', function ($query) {
                            $query->whereNotIn('status', ['paid', 'cancelled']);
                        })
                        ->orWhere('order_id', null);
                })->where('id', $cart->id)->first();
            }

            if (!$cart) {
                if ($userId || $session) {
                    $cart = $this->cart->create(['user_id' => $userId, 'session' => $session]);
                    DB::commit();
                } else {
                    DB::rollBack();
                    $this->logger->error('Error when creating a shopping cart: No user ID or session ID available');
                    return null;
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting cart: ' . $e->getMessage());
            return null;
        }

        return $cart;
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
        if (!$product) {
            return null;
        }

        $cart = $this->getCart();
        if (!$cart) {
            $this->logger->error('Error when getting a shopping cart');
            return null;
        }

        try {
            $this->cartProductService->createCartProduct([
                'cart_id' => $cart->id,
                'product_id' => $data['id'],
                'quantity' => $data['quantity'],
            ]);
        } catch (\Exception $e) {
            $this->logger->error('Error when creating an entry in the cart_products table: ' . $e->getMessage());
            return null;
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
            $this->logger->error('Error when getting a shopping cart');
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
