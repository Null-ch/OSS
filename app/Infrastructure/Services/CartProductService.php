<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Factories\MessageFactory;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;

class CartProductService
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
     * messageFactory
     *
     * @var object
     */
    protected $messageService;


    
    /**
     * __construct
     *
     * @param  mixed $cartProduct
     * @param  mixed $logger
     * @param  mixed $product
     * @param  mixed $messageService
     */
    protected function __construct(CartProduct $cartProduct, LogInterface $logger, Product $product, MessageService $messageService)
    {
        (object) $this->cartProduct = $cartProduct;
        (object) $this->logger = $logger;
        (object) $this->product = $product;
        (object) $this->messageService = $messageService;
    }

    /**
     * getCartProduct
     *
     * @param  mixed $cart
     * @param  mixed $product
     * @return object
     */
    public function getCartProduct(object $cart, object $product): ?object
    {
        try {
            $cartProduct = $this->cartProduct::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the products: ' . $e->getMessage());
            return null;
        }

        return $cartProduct;
    }

    public function getCartProductsByCartId(int $id): ?object
    {
        try {
            $cartProducts = $this->cartProduct::where('cart_id', $id);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the products: ' . $e->getMessage());
            return null;
        }

        return $cartProducts;
    }

    /**
     * createCartProduct
     *
     * @param  array $data
     * @return string|null
     */
    public function createCartProduct(array $data): ?string
    {
        DB::beginTransaction();
        try {
            $this->cartProduct->create($data);
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when  creating an entry in the cart_products table: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * updateCartProduct
     *
     * @param  mixed $cart
     * @param  mixed $product
     * @param  array $data
     * @return string|null
     */
    public function updateCartProduct(object $cart, object $product, array $data): ?string
    {
        DB::beginTransaction();
        try {
            $cartProduct = $this->getCartProduct($cart, $product);
            foreach ($data as $key => $value) {
                $cartProduct->$key = $value;
            }
            $cartProduct->save();
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when update cartProduct object: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * deleteCartProduct
     *
     * @param  mixed $cart
     * @param  mixed $product
     * @return string|null
     */
    public function deleteCartProduct(object $cart, object $product): ?string
    {
        DB::beginTransaction();
        try {
            $cartProduct = $this->getCartProduct($cart, $product);
            $cartProduct->delete();
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete the cartProduct object: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * clearingByCartId
     *
     * @param  int $id
     * @return string
     */
    public function clearingByCartId(int $id): ?string
    {
        DB::beginTransaction();
        try {
            $cartProduct = $this->getCartProductsByCartId($id);
            foreach ($cartProduct as $item) {
                $item->delete();
            }
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete the cartProduct object: ' . $e->getMessage());
            return null;
        }
    }
}
