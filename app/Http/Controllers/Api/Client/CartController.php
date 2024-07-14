<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\Client\ClientCartService;
use App\Infrastructure\Services\ResponseService;
use App\Http\Requests\Client\Cart\AddCartProductRequest;
use App\Http\Requests\Client\Cart\UpdateCartProductRequest;

class CartController extends Controller
{    
    /**
     * cartService
     *
     * @var object
     */
    protected $cartService;
   
    /**
     * responseService
     *
     * @var object
     */
    protected $responseService;

    public function __construct(ClientCartService $cartService, ResponseService $responseService)
    {
        $this->cartService = $cartService;
        $this->responseService = $responseService;
    }

    /**
     * Getting a list of products in the shopping cart
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $cartData = $this->cartService->getCartProducts();
        $responseData = $this->responseService->getResponse($cartData);
        return response()->json($responseData, JSON_UNESCAPED_UNICODE);
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
        $productData = $request->validated();
        $responseData = $this->cartService->addProduct($productData);
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
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
        $productData = $request->validated();
        $responseData = $this->cartService->updateProduct($productData);
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
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
        $responseData = $this->cartService->deleteProduct($id);
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * updateCart
     *
     * @param  mixed $request
     * @return void
     */
    public function updateCart(\Illuminate\Http\Request $request)
    {
        // $responseData = $this->cartService->updateCart($request);
        // $response = $this->responseService->getResponse($responseData);
        return response()->json($request->all(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * clearCart
     *
     * @param  mixed $id
     * @return void
     */
    public function clearCart($id)
    {
        // $responseData = $this->cartService->clearCart($id);
        $responseData = ['sps', $id];
        $response = $this->responseService->getResponse($responseData);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
}
