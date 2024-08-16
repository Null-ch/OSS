<?php

namespace App\Infrastructure\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Events\ProductAddedToCartEvent;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\CartInterface;
use App\Infrastructure\Services\CartProductService;
use App\Infrastructure\Validation\CartUpdateValidator;

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
     * @var object
     */
    protected $messageService;
    /**
     * cartValidator
     *
     * @var object
     */
    protected $cartValidator;

    /**
     * __construct
     *
     * @param Cart $cart
     * @param LogInterface $logger
     * @param Product $product
     * @param CartProductService $cartProductService
     * @param ProductService $productService
     * @param CartUpdateValidator $cartValidator
     */
    public function __construct(
        Cart $cart,
        LogInterface $logger,
        Product $product,
        CartProductService $cartProductService,
        ProductService $productService,
        MessageService $messageService,
        CartUpdateValidator $cartValidator
    ) {
        $this->cart = $cart;
        $this->logger = $logger;
        $this->product = $product;
        $this->cartProductService = $cartProductService;
        $this->productService = $productService;
        $this->messageService = $messageService;
        $this->cartValidator = $cartValidator;
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
            $cartsQuery = $this->cart::where(function ($query) use ($userId, $sessionId) {
                $query->where(function ($query) use ($userId, $sessionId) {
                    $query->whereNotNull('order_id')
                          ->whereHas('order', function ($query) {
                              $query->whereNotIn('status', ['2', '3']);
                          })
                          ->orWhere('order_id', null);
                })
                ->when($userId, function ($query, $userId) {
                    return $query->where('user_id', $userId);
                })
                ->when($sessionId, function ($query, $sessionId) {
                    return $query->where('session', $sessionId);
                });
            });
            $cart = $cartsQuery->get()->first();
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
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
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }

        $cart->products;
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
                $products = $cart->cart_products;
            }

            if ($products) {
                foreach ($products as $product) {
                    $product->images;
                }
            } else {
                return null;
            }
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }

        return $cart;
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
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }
    }

    /**
     * Method updateCart
     *
     * @param \Illuminate\Http\Request $request [explicite description]
     *
     * @return null | array | Cart
     */
    public function updateCart(\Illuminate\Http\Request $request)
    {
        $data = $this->cartValidator->validate($request->all());

        if (!isset($data['cart'])) {
            $this->logger->error('Cart data not found in request.');
            return null;
        }

        try {
            $cartRequestData = $data['cart'];
            $cart = $this->getCart();
            $this->cartProductService->clearingByCartId($cart->id);
            $cartData = $this->productService->checkAvailability($cartRequestData);

            if ($cartData['error']) {
                return $cartData;
            }

            foreach ($cartRequestData as $key => $value) {
                $productId = $value['id'];
                $product = $this->product->find($productId);
                if ($product) {
                    $this->cartProductService->createCartProduct(['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => $value['quantity']]);
                    event(new ProductAddedToCartEvent($productId, $value['quantity']));
                }
            }
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }
        $cart->products;
        return $cart;
    }

    /**
     * Method findCartById
     *
     * @param int $id
     *
     * @return null | Cart
     */
    public function findCartById(int $id): ?Cart
    {
        try {
            return $this->cart::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }
    }
}
