<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['title' => "string", 'description' => "string", 'price' => "string", 'image' => "string", 'created_at' => "\Illuminate\Support\Carbon", 'updated_at' => "\Illuminate\Support\Carbon"])] public function definition(): array
    {
        return [
            'title'       => $this->faker->firstName,
            'description' => $this->faker->text($maxNbChars = 200),
            'price'       => $this->faker->numerify('##'),
            'image'       => 'storage/images/file.png',
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
