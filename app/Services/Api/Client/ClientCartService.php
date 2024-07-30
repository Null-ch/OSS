<?php

namespace App\Services\Api\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Events\ProductAddedToCart;
use Illuminate\Support\Facades\DB;
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
    public function updateCart(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        try {
            isset($data['cart']);
        } catch (\Exception $e) {
            $this->logger->error('Error when  creating an entry in the cart_products table: ' . $e->getMessage());
            return null;
        }

        DB::beginTransaction();
        try {
            $cart = $this->getCart();
            $this->cartProductService->clearingByCartId($cart->id);
            $cartData = $this->productService->checkAvailability($data['cart']);
            if ($cartData && !$cartData['error']) {
                $cart = $this->getCart();
            } else {
                return $cartData;
            }
 
            foreach ($data as $key => $value) {
                $product = $this->product->find($value['id']);
                if (isset($product)) {
                    $this->cartProductService->createCartProduct(['cart_id' => $cart->id, 'product_id' => $product->id]);
                    event(new ProductAddedToCart($product->id, $value['quantity']));
                }
            }
            DB::commit();
            return $cart->id;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when  creating an entry in the cart_products table: ' . $e->getMessage());
            return null;
        }
    }
}
