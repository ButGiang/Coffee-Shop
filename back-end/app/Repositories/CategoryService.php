<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function get()
    {
        $categories = Category::orderBy('id')->get();
        return $categories;
    }

    public function get_detail($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function create($categoryName, $categoryStatus)
    {
        DB::beginTransaction();
        try {
            $newCategory = new Category();
            $newCategory->name = $categoryName;
            $newCategory->status = $categoryStatus;
            $newCategory->save();
            DB::commit();
            return ['success' => 'Category created successfully'];
        } catch (QueryException $e) {
            DB::rollBack();
            if ($e->getCode() == 23505)
                return ['error' => 'Duplicate key value'];
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function category_update($categoryId, $categoryName, $categoryStatus)
    {
        DB::beginTransaction();
        try {
            $category = $this->get_detail($categoryId);
            if (!$category)
                return ['error' => 'Category not found'];
            $category->name = $categoryName;
            $category->status = $categoryStatus;
            $category->save();
            DB::commit();
            return ['success' => 'Category updated successfully'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        DB::beginTransaction();
        try {
            if ($category) {
                $category->delete();
                Product::where('category', $id)->update(['category' => null]);
                DB::commit();
                return ['success' => 'Category deleted successfully'];
            } else
                return ['error' => 'category not found'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }
}
