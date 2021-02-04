<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);

        return ProductResource::collection($products);
    }

    public function showOne($id)
    {
        $product = Product::findOrFail($id);

        return [
            "product" => $product,
            "categories" => $product->categories,
        ];
    }
}
