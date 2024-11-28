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

        $types->each(function ($type) {
            $typeRecord = SubscriptionType::create(
                ['name' => $type],
            );

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
