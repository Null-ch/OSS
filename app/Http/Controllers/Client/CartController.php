<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Client\CartService;
use App\Http\Requests\Client\Cart\AddProductRequest;
use App\Http\Requests\Client\Cart\DeleteProductRequest;

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
    public function addProduct(AddProductRequest $request)
    {
        $data = $request->validated();
        $response = $this->cartService->addProduct($data);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function updateProduct(int $id, $data)
    {
    }
    public function deleteProduct($id)
    {
        $response = $this->cartService->deleteProduct($id);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
