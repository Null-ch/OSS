<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ProductService;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (object) $products = $this->productService->getProducts();

        return view('admin.main.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->productService->getAllCategories();
        return view('admin.main.product.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        (array) $data = $request->validated();
        (array) $images = $request->allFiles();
        (object) $this->productService->createProduct($data, $images);
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the current product.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        (object) $product = $this->productService->getProduct($id);
        return view('admin.main.product.show', compact('product'));
    }

    /**
     * Edit the current product.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        (object) $product = $this->productService->getProduct($id);
        (array) $categories = $this->productService->getAllCategories();
        return view('admin.main.product.edit', compact('product', 'categories'));
    }

    /**
     * Update current product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // (array) $data = $request->validated();
        // $this->userService->updateUser($data, $id);
        // return redirect()->route('admin.user.edit', $id);
    }

    /**
     * Remove current product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->destroy($id);
        return redirect()->route('admin.products.index');
    }
}
