<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alias;
use App\Models\Company;
use App\Models\Fund;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        Manager::factory(20)->create();
        Company::factory(40)->create();
        Fund::factory(50)
            ->has(Alias::factory()->count(rand(1,9)))
            ->create();
    }
}
