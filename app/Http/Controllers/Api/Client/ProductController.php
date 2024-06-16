<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\Client\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Getting a list of products (client)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $response = $this->productService->getProducts();

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * Getting a product by id (client)
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function show($id)
    {
        (object) $response = $this->productService->getProduct($id);

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Method checkAvailability
     *
     * @param \Illuminate\Http\Request $request [explicite description]
     *
     * @return void
     */
    public function checkAvailability(\Illuminate\Http\Request $request)
    {
        $response = $this->productService->checkAvailability($request);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
