<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create users admin seeds

        User::factory()->create([
            'type' => User::ADMIN,
            'email' => 'admin@admin.com'
        ]);

        User::factory(99)->create([
            'type' => User::ADMIN
        ]);
    }
}
