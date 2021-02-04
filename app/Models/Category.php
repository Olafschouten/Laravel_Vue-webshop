<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        // Find better way!!!
        return $this->belongsToMany(
            Product::class,
            'category_products',
            'category_id',
            'product_id'
        )->withTimestamps();
    }

    public static function getCategories()
    {
        return Category::all();
    }

    public static function getCategory($id)
    {
        return Category::find($id);
    }

    public static function getSpecificCategories($id)
    {
        // Find better way!!!
        return \DB::table('categories AS c')
            ->join('category_products', 'category_id', '=', 'c.id')
            ->select('c.id', 'c.title')
            ->where('category_products.product_id', $id)
            ->get();
    }
}
