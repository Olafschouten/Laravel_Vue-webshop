<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        // Find better way!!!
        return $this->belongsToMany(
            Category::class,
            'category_products',
            'product_id',
            'category_id'
        )->withTimestamps();
    }

    /**
     * @return Product[]|Collection
     */
    public static function getAll(): Collection|array
    {
        return Product::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getOne($id): mixed
    {
        return Product::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getSpecificProduct($id): mixed
    {
        // Find better way!!!
        return \DB::table('products AS p')
            ->join('category_products', 'category_id', '=', 'p.id')
            ->select('p.id', 'p.title', 'p.description', 'p.price')
            ->where('category_products.product_id', $id)
            ->get();
    }
}
