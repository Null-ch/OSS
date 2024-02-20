<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\CartService;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $response = $this->cartService->getCartProducts();

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * [Description for addProduct]
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

    public function updateProduct(UpdateCartProductRequest $request)
    {
        $data = $request->validated();
        $response = $this->cartService->updateProduct($data);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function deleteProduct($id)
    {
        $response = $this->cartService->deleteProduct($id);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
