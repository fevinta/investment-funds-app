<?php

namespace Database\Seeders;

use App\Models\Alias;
use App\Models\Company;
use App\Models\Fund;
use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fund::factory()
            ->recycle(Company::all())
            ->has(Alias::factory()->count(random_int(1, 100)), 'Aliases')
            ->has(Company::factory()->count(random_int(1, 100)), 'InvestingCompanies')
            ->count(100)
            ->create();
    }
}
