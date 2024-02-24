<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ProductService;

class ProductController extends Controller
{
    protected $producrService;

    public function __construct(ProductService $producrService)
    {
        $this->producrService = $producrService;
    }

    /**
     * Getting a list of products (client)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $response = $this->producrService->getProducts();

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
        (object) $response = $this->producrService->getProduct($id);

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
