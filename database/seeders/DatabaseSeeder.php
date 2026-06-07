<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testEmail = 'test@example.com';
        if (User::query()->where('email', $testEmail)->doesntExist()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => $testEmail,
                'password' => Hash::make('password')
            ]);
        }

        $this->call([
            CategorySeeder::class,
            PaymentMethodSeeder::class,
            CompanySeeder::class,
            SubscriptionSeeder::class
        ]);
    }
}
