<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Getting a list of products in the shopping cart
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (object) $response = $this->categoryService->getCategories();

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
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
        (object) $response = $this->categoryService->getProducts($id);

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
