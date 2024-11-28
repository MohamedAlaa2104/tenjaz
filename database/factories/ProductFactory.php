<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SubscriptionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'subscription_type_id' => fake()->randomElement(
                SubscriptionType::all()
                    ->pluck('id')
                    ->toArray()
            ),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'price' => fake()->randomFloat(),
            'slug' => fake()->slug(),
            'is_active' => fake()->boolean(),
        ];
    }
}
