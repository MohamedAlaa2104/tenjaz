<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SubscriptionType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $types = new Collection(['normal', 'gold', 'silver']);
        $discountPercentage = 0;

        $types->each(function ($type) use (&$discountPercentage) {
            $typeRecord = SubscriptionType::create(
                [
                    'name' => $type,
                    'discount_percentage' => $discountPercentage,
                ],
            );

            $discountPercentage += 10;

            User::factory()->create([
                'name' => "{$type} user",
                'username' => "{$type}user",
                'email' => "{$type}@example.com",
                'subscription_type_id' => $typeRecord->id,
            ]);
        });



        Product::factory(100)->create();
    }
}
