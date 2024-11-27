<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => $this->faker->image(),
            'price' => $this->faker->randomFloat(),
            'slug' => $this->faker->slug(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
