<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;

class CategoryController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        return CategoryResource::collection($categories);
    }

    /**
     * @param $id
     * @return array
     */
    #[ArrayShape(["category" => "mixed", "products" => "mixed"])] public function showOne($id): array
    {
        $category = Category::findOrFail($id);

        return [
            "category" => $category,
            "products" => $category->products,
        ];
    }
}
