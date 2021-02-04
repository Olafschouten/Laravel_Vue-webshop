<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->times(50)
            ->create();

        // DB::table('products')->insert([
        //     'title' => 'p1',
        //     'description' => 'descrioption 1',
        //     'price' => '10',
        //     'image' => 'storage/images/file.png',
        //     'url' => '/#/product/',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
