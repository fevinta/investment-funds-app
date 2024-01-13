<?php

use App\Mail\DuplicateFundWarningMail;
use App\Models\Company;
use App\Models\Fund;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('returns a paginated list of all funds', function () {
    Fund::factory()->count(10)->create();

    $response = $this->get('/api/funds');

    $response->assertStatus(200);

    $response->assertJsonCount(10, 'data');

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'start_year',
                'company_id',
                'created_at',
                'updated_at',
                'manager_company' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
            ],
        ],
    ]);
});

it('returns a paginated list of funds filter by year', function () {
    $year = 2020;
    Fund::factory()->create(['start_year' => $year]);
    Fund::factory()->create(['start_year' => $year]);
    Fund::factory()->create(['start_year' => $year + 1]);

    $response = $this->get('/api/funds?start_year=' . $year);

    $response->assertJsonCount(2, 'data');
});

it('returns a paginated list of funds filter by company', function () {
    Fund::factory()->create();
    Fund::factory()->create();

    $response = $this->get('/api/funds?company=' . Fund::first()->ManagerCompany->name);

    $response->assertJsonCount(1, 'data');
});

it('returns a paginated list of funds filter by name', function () {
    $name = "test_name";
    Fund::factory()->create(['name' => $name]);
    Fund::factory()->count(10)->create();

    $response = $this->get('/api/funds?name=' . $name);

    $response->assertJsonCount(1, 'data');
});

it('send and email to the user after a duplicated fund is created', function () {
    Mail::fake();

    User::factory()->create();

    $company = Company::factory()->create();

    Fund::factory()->create([
        'name'       => "Fund 1",
        'company_id' => $company->id
    ]);

    Mail::assertNothingSent();

    Fund::factory()->create([
        'name'       => "Fund 1",
        'company_id' => $company->id
    ]);

    Mail::assertSent(DuplicateFundWarningMail::class);
});
