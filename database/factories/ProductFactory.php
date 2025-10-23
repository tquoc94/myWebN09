<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'category_id'  => Category::inRandomOrder()->first()->id,
            'name'         => ucfirst($name),
            'slug'         => Str::slug($name.'-'.Str::random(3)),
            'price'        => $this->faker->numberBetween(50_000, 300_000),
            'image_path'   => null,
            'stock'        => $this->faker->numberBetween(0, 100),
            'description'  => $this->faker->sentence(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
