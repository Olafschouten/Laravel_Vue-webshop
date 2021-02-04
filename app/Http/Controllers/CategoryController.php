<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        return CategoryResource::collection($categories);
    }

    public function showOne($id)
    {
        $category = Category::findOrFail($id);

        return [
            "category" => $category,
            "products" => $category->products
        ];
    }
}
