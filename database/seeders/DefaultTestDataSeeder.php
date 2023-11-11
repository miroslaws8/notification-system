<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->firstOrCreate([
            'email' => env('TEST_EMAIL', 'test@gmail.com')
        ], [
            'name' => 'test',
            'password' => 'test'
        ]);
    }
}
