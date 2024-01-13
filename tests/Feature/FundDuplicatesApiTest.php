<?php

use App\Models\Fund;

it('returns an empty list when there are no duplicated funds', function () {
    $fund = Fund::factory()->create();

    $response = $this->get('/api/funds/' . $fund->id . '/duplicates');

    $response->assertStatus(200)->assertJsonCount(0, 'data');
});

it('returns a list of all duplicated funds', function () {
    $fund = Fund::factory()->create();
    $fund->ManagerCompany->ManagedFunds()->create([
        'name'       => $fund->name,
        'start_year' => 2025,
    ]);

    $response = $this->get('/api/funds/' . $fund->id . '/duplicates');

    $response->assertStatus(200)->assertJsonCount(1, 'data');
});

it('returns a list of all duplicated funds by alias', function () {
    $fund = Fund::factory()->create();
    $fund->Aliases()->create(['name' => "Alias Name"]);
    $fund->ManagerCompany->ManagedFunds()->create([
        'name'       => "Alias Name",
        'start_year' => 2027,
    ]);

    $response = $this->get('/api/funds/' . $fund->id . '/duplicates');

    $response->assertStatus(200)->assertJsonCount(1, 'data');
});
