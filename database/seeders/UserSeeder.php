<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(1)
            ->hasVehicles(4)
            ->create();

        User::factory()
            ->count(1)
            ->hasVehicles(3)
            ->create();

        User::factory()
            ->count(1)
            ->hasVehicles(5)
            ->create();

        User::factory()
            ->count(1)
            ->hasVehicles(2)
            ->create();

    }
}
