<?php

namespace App\Infrastructure\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Events\ProductAddedToCart;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\CartInterface;
use App\Infrastructure\Services\CartProductService;

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
     * messageService
     *
     * @var mixed
     */
    protected $messageService;

    /**
     * __construct
     *
     * @param Cart $cart
     * @param LogInterface $logger
     * @param Product $product
     * @param CartProductService $cartProductService
     * @param ProductService $productService
     */
    protected function __construct(
        Cart $cart,
        LogInterface $logger,
        Product $product,
        CartProductService $cartProductService,
        ProductService $productService,
        MessageService $messageService
    ) {
        $this->cart = $cart;
        $this->logger = $logger;
        $this->product = $product;
        $this->cartProductService = $cartProductService;
        $this->productService = $productService;
        $this->messageService = $messageService;
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
            $userId = auth()->check() ? auth()->user()->id : null;
            $sessionId = request()->header('session-id') ? request()->header('session-id') : null;

            if ($userId) {
                $cart = $this->cart::where('user_id', $userId)->first();
            } elseif ($sessionId) {
                $cart = $this->cart::where('session', $sessionId)->first();
            }

            if ($cart) {
                $cart = $this->cart::where(function ($query) use ($cart) {
                    $query->whereNotNull('order_id')
                        ->whereHas('order', function ($query) {
                            $query->whereNotIn('status', ['2', '3']);
                        })
                        ->orWhere('order_id', null);
                })->where('id', $cart->id)->first();
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting cart: ' . $e->getMessage());
            return null;
        }

        DB::beginTransaction();
        try {
            if (!$cart) {
                if ($userId || $sessionId) {
                    $cart = $this->cart->create(['user_id' => $userId, 'session' => $sessionId]);
                } else {
                    DB::rollBack();
                    $this->logger->error('Error when creating a shopping cart: No user ID or session ID available');
                    return null;
                }
            }
            DB::commit();
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

        return $cart;
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
            return $this->messageService->getMessage('success');
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

    /**
     * clearCart
     *
     * @param  int $id
     * @return string
     */
    public function clearCart(int $id): ?string
    {
        DB::beginTransaction();
        try {
            $this->cartProductService->clearingByCartId($id);
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete the cartProduct object: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Method updateCart
     *
     * @param \Illuminate\Http\Request $request [explicite description]
     *
     * @return Cart
     */
    public function updateCart(\Illuminate\Http\Request $request): ?Cart
    {
        $data = $request->all();

        if (!isset($data['cart'])) {
            $this->logger->error('Cart data not found in request.');
            return null;
        }

        try {
            $cartRequestData = $data['cart'];
            $cart = $this->getCart();
            $this->cartProductService->clearingByCartId($cart->id);
            $cartData = $this->productService->checkAvailability($cartRequestData);

            if (!$cartData && $cartData['error']) {
                return $cartData;
            }

            foreach ($cartRequestData as $key => $value) {
                $productId = $value['id'];
                $product = $this->product->find($productId);
                if ($product) {
                    $this->cartProductService->createCartProduct(['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => $value['quantity']]);
                    event(new ProductAddedToCart($productId, $value['quantity']));
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when updating cart by client API: ' . $e->getMessage(), $e->getTrace());
            return null;
        }
        $cart->products;
        return $cart;
    }
}
