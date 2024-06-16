<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\Client\CartService;
use App\Http\Requests\Client\Cart\AddCartProductRequest;
use App\Http\Requests\Client\Cart\UpdateCartProductRequest;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Getting a list of products in the shopping cart
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $response = $this->cartService->getCartProducts();

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Adding a product to the shopping cart
     *
     * @param int $id
     * @param int $quantity
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function addProduct(AddCartProductRequest $request)
    {
        $data = $request->validated();
        $response = $this->cartService->addProduct($data);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Updating an item in the shopping cart
     *
     * @param UpdateCartProductRequest $request
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function updateProduct(UpdateCartProductRequest $request)
    {
        $data = $request->validated();
        $response = $this->cartService->updateProduct($data);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * Removing a product from the shopping cart
     *
     * @param mixed $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function deleteProduct($id)
    {
        $response = $this->cartService->deleteProduct($id);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

}
