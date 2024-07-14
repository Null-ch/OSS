<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Infrastructure\Services\ResponseService;
use App\Services\Api\Client\ClientProductService;

class ProductController extends Controller
{
    protected $productService;
    protected $responseService;

    public function __construct(ClientProductService $productService,  ResponseService $responseService)
    {
        $this->productService = $productService;
        $this->responseService = $responseService;
    }

    /**
     * Getting a list of products (client)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $data = $this->productService->getProducts(5);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
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
        (object) $data = $this->productService->getProduct($id);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * checkAvailability
     *
     * @param  object $request
     * @return void
     */
    public function checkAvailability(Request $request)
    {
        $data = $this->productService->checkAvailability($request);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
}
