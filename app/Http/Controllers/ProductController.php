<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;

class ProductController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);

        return ProductResource::collection($products);
    }

    /**
     * @param $id
     * @return array
     */
    #[ArrayShape(["product" => "mixed", "categories" => "mixed"])] public function showOne($id): array
    {
        $product = Product::findOrFail($id);

        return [
            "product"    => $product,
            "categories" => $product->categories,
        ];
    }
}
