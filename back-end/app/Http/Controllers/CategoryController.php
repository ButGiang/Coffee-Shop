<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function get()
    {
        $categories = $this->categoryService->get();
        return $categories;
    }

    public function get_detail($id)
    {
        $category_detail = $this->categoryService->get_detail($id);
        return $category_detail;
    }

    public function create(Request $request)
    {
        $categoryName = $request->get('categoryName');
        $categoryStatus = $request->get('categoryStatus');

        $response = $this->categoryService->create($categoryName, $categoryStatus);
        if (isset($response['error']))
            return $response['error'];

        return $response['success'];
    }

    public function edit(Request $request)
    {
        $categoryId = $request->get('categoryId');
        $categoryName = $request->get('categoryName');
        $categoryStatus = $request->get('categoryStatus');

        $response = $this->categoryService->category_update($categoryId, $categoryName, $categoryStatus);
        if (isset($response['error']))
            return $response['error'];

        return $response['success'];
    }

    public function delete($id)
    {
        $response = $this->categoryService->delete($id);

        if (isset($response['error']))
            return $response['error'];

        return $response['success'];
    }
}
