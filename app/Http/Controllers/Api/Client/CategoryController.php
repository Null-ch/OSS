<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Infrastructure\Services\ResponseService;
use App\Services\Api\Client\ClientCategoryService;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $responseService;


    public function __construct(ClientCategoryService $categoryService, ResponseService $responseService)
    {
        $this->categoryService = $categoryService;
        $this->responseService = $responseService;
    }

    /**
     * Getting a list of products in the shopping cart
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $data = $this->categoryService->getCategories(10);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Getting products by category id
     *
     * @param mixed $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function getProducts($id)
    {
        (object) $data = $this->categoryService->getProducts($id);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }

    public function show($id)
    {
        (object) $data = $this->categoryService->getCategory($id);
        $response = $this->responseService->getResponse($data);
        return response()->json($response, JSON_UNESCAPED_UNICODE);
    }
}
