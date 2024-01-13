<?php

namespace App\Interfaces;

use App\Models\Fund;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface FundRepositoryInterface
{
    public function search($filters = []): Paginator;

    public function getPossibleDuplicates(): Collection;

    public function updateFund(Fund $fund, array $data): bool;
}
