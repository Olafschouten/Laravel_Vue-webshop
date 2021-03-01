<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class CategoryProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['category_id' => "\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'product_id' => "\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'created_at' => "\Illuminate\Support\Carbon", 'updated_at' => "\Illuminate\Support\Carbon"])] public function definition()
    {
        return [
            'category_id' => Category::factory()->create()->id,
            'product_id'  => Product::factory()->create()->id,
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
