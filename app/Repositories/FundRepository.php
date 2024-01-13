<?php

namespace App\Repositories;

use App\Interfaces\FundRepositoryInterface;
use App\Models\Fund;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;

class FundRepository implements FundRepositoryInterface
{
    public function search($filters = []): Paginator
    {
        return Fund::query()
            ->with('ManagerCompany')
            ->when($filters['name'] ?? false, function (Builder $query, string $name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->when($filters['company'] ?? false, function (Builder $query, string $company) {
                $query->whereHas('ManagerCompany', function (Builder $query) use ($company) {
                    $query->where('name', 'like', "%{$company}%");
                });
            })
            ->when($filters['start_year'] ?? false, function (Builder $query, int $year) {
                $query->where('start_year', $year);
            })
            ->simplePaginate();
    }

    public function getPossibleDuplicates(): Collection
    {
        return Fund::query()
            ->select('name', 'start_year')
            ->selectRaw('count(*) as count')
            ->groupBy('name', 'start_year')
            ->having('count', '>', 1)
            ->get();
    }

    public function updateFund(Fund $fund, array $data): bool
    {
        return $fund->update($data);
    }
}
