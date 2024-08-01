<?php

namespace App\Services\Api\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Events\ProductAddedToCart;
use App\Infrastructure\Services\CartService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Services\Api\Client\ClientProductService;
use App\Infrastructure\Services\CartProductService;
use App\Infrastructure\Validation\CartUpdateValidator;

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
     * productService
     *
     * @var object
     */
    protected $productService;

    /**
     * cartUpdateValidator
     *
     * @var mixed
     */
    protected $cartUpdateValidator;

    /**
     * __construct
     *
     * @param  Cart $cart
     * @param  LogInterface $logger
     * @param  Product $product
     * @param  CartProductService $cartProductService
     * @param  ClientProductService $productService
     * @param  MessageService $messageService
     */
    public function __construct(
        Cart $cart,
        LogInterface $logger,
        Product $product,
        CartProductService $cartProductService,
        ClientProductService $productService,
        MessageService $messageService,
        CartUpdateValidator $cartUpdateValidator
    ) {
        parent::__construct($cart, $logger, $product, $cartProductService, $productService, $messageService);
        $this->cartUpdateValidator = $cartUpdateValidator;
    }

    /**
     * Update cart
     *
     * @return string | null
     * 
     */
    public function updateCart(\Illuminate\Http\Request $request): ?string
    {
        $data = $request->all();

        if (!isset($data['cart'])) {
            $this->logger->error('Cart data not found in request.');
            return null;
        }
        
        try {
            $cart = $this->getCart();
            $cartRequestData = $data['cart'];
            $this->cartProductService->clearingByCartId($cart->id);
            $cartData = $this->productService->checkAvailability($cartRequestData);

            if ($cartData && !$cartData['error']) {
                $cart = $this->getCart();
            } else {
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
        return $cart->id;
    }
}
