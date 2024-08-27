<?php

namespace App\Http\Controllers;

use App\Repositories\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function get()
    {
        $products = $this->productService->get();
        return $products;
    }

    public function getByPrice()
    {
        $products = $this->productService->getByPrice();
        return $products;
    }

    public function filterByCategory($id)
    {
        $products = $this->productService->filterByCategory($id);
        return $products;
    }

    public function getDetailProduct($id)
    {
        $products = $this->productService->getDetailProduct($id);
        return $products;
    }

    public function create(Request $request)
    {
        $productName = $request->get('productName');
        $productPrice = $request->get('productPrice');
        $productDescribe = $request->get('productDescribe');

        if ($request->hasFile('productImage')) {
            $productImage = $request->file('productImage');
            $productImageName = time() . '.' . $productImage->extension();
            $productImage->storeAs('public/images', $productImageName);
            $productImagePath = 'storage/images/' . $productImageName;
        } else {
            $productImagePath = null;
        }

        $response = $this->productService->create($productName, $productPrice, $productDescribe, $productImagePath);
        if (isset($response['error']))
            return $response['error'];

        return $response['success'];
    }

    public function edit(Request $request) {
        $response = $this->productService->edit($request);
        if (isset($response['error']))
            return $response['error'];

        return $response['success'];
    }
}
