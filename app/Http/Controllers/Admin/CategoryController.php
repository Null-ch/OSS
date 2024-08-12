<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminCategoryService;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(AdminCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (object) $categories = $this->categoryService->getCategories(10);
        return view('admin.main.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.main.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $this->categoryService->createCategory($data);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        (object) $category = $this->categoryService->getCategory($id);
        return view('admin.main.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        (object) $category = $this->categoryService->getCategory($id);
        return view('admin.main.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->categoryService->updateCategory($data, $id);
        $category = $this->categoryService->getCategory($id);
        return view('admin.main.category.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryService->destroy($id);
        return response()->json([
            'success' => true,
            'message' => "Пользователь успешно удален",
        ]);
    }

    /**
     * Func for chenge activity of category
     *
     * @param mixed $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function toggleActivity($id)
    {
        $response = $this->categoryService->toggleActivity($id);

        return response()->json($response, 200);
    }
}
