<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function get()
    {
        $products = Product::orderBy('name')->get();
        return $products;
    }

    public function getByPrice()
    {
        $products = Product::orderBy('price')->orderBy('name')->get();
        return $products;
    }

    public function filterByCategory($id)
    {
        $products = Product::where('category', $id)->get();
        return $products;
    }

    public function getDetailProduct($id)
    {
        $products = Product::where('id', $id)->get();
        return $products;
    }

    public function create($productName, $productPrice, $productCategory, $productDescribe, $productImagePath)
    {
        DB::beginTransaction();
        try {
            $newProduct = new Product();
            $newProduct->name = $productName;
            $newProduct->price = $productPrice;
            $newProduct->category = $productCategory;
            $newProduct->description = $productDescribe;
            $newProduct->image = $productImagePath;
            $newProduct->save();
            DB::commit();
            return ['success' => 'Product created successfully'];
        } catch (QueryException $e) {
            DB::rollBack();
            if ($e->getCode() == 23505)
                return ['error' => 'Duplicate key value'];
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function edit($request)
    {
        $productId = $request->input('id');
        $productName = $request->get('name');
        $productPrice = $request->get('price');
        $productDescription = $request->get('description');
        $productCategory = $request->get('category');

        DB::beginTransaction();
        try {
            $product = Product::findOrFail($productId);

            $product->name = $productName;
            $product->price = $productPrice;
            $product->description = $productDescription;
            $product->category = $productCategory;
            $product->save();
            DB::commit();
            return ['success' => 'Product updated successfully'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['error' => 'Failed to update product: ' . $e->getMessage()];
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        DB::beginTransaction();
        try {
            if ($product) {
                $product->delete();
                DB::commit();
                return ['success' => 'Product deleted successfully'];
            } else
                return ['error' => 'product not found'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }
}
