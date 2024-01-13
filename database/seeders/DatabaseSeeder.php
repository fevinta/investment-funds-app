<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alias;
use App\Models\Company;
use App\Models\Fund;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory()
            ->has(
                Fund::factory()
                    ->for(Company::factory(), 'ManagerCompany')
                    ->has(Alias::factory()->count(random_int(1, 100)), 'Aliases')
                    ->count(random_int(1, 100)),
                'InvestedFunds'
            )
            ->count(random_int(1, 100))
            ->create();
    }
}
