<?php

namespace App\Infrastructure\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Support\Facades\DB;
use App\Events\ProductRemovedFromCart;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\CartProductInterface;

class CartProductService implements CartProductInterface
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
     * @param CartProduct $cartProduct
     * @param LogInterface $logger
     * @param Product $product
     * @param MessageService $messageService
     */
    public function __construct(
        CartProduct $cartProduct,
        LogInterface $logger,
        Product $product,
        MessageService $messageService
    ) {
        $this->cartProduct = $cartProduct;
        $this->logger = $logger;
        $this->product = $product;
        $this->messageService = $messageService;
    }
    
    /**
     * Method getCartProduct
     *
     * @param Cart $cart [explicite description]
     * @param Product $product [explicite description]
     *
     * @return CartProduct
     */
    public function getCartProduct(Cart $cart, Product $product): ?CartProduct
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
            $cartProducts = $this->cartProduct::where('cart_id', $id)->get();
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
     * Method updateCartProduct
     *
     * @param Cart $cart [explicite description]
     * @param Product $product [explicite description]
     * @param array $data [explicite description]
     *
     * @return string
     */
    public function updateCartProduct(Cart $cart, Product $product, array $data): ?string
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
     * Method deleteCartProduct
     *
     * @param Cart $cart [explicite description]
     * @param Product $product [explicite description]
     *
     * @return string
     */
    public function deleteCartProduct(Cart $cart, Product $product): ?string
    {
        DB::beginTransaction();
        try {
            $cartProduct = $this->getCartProduct($cart, $product);
            event(new ProductRemovedFromCart($cartProduct->product_id, $cartProduct->quantity));
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
        try {
            $cartProducts = $this->getCartProductsByCartId($id);
            foreach ($cartProducts as $item) {
                event(new ProductRemovedFromCart($item->product_id, $item->quantity));
                $item->delete();
            }
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            $this->logger->error('Error when delete the cartProduct object: ' . $e->getMessage());
            return null;
        }
    }
}
