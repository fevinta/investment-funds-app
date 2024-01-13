<?php

namespace App\Repositories;

use App\Interfaces\FundRepositoryInterface;
use App\Models\Fund;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

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

    public function getAllPossibleDuplicates(Fund $fund): Collection
    {
        $aliases = $fund->aliases()->pluck('name');

        return Fund::where(function ($query) use ($fund, $aliases) {
            $query->where('name', $fund->name);

            $query->orWhereHas('aliases', function ($subQuery) use ($fund) {
                $subQuery->where('name', $fund->name);
            });

            if ($aliases->isNotEmpty()) {
                $query->orWhereIn('name', $aliases);
                $query->orWhereHas('aliases', function ($subQuery) use ($aliases) {
                    $subQuery->whereIn('name', $aliases);
                });
            }
        })
            ->where('company_id', $fund->company_id)
            ->where('id', '!=', $fund->id)
            ->get();
    }

    public function updateFund(Fund $fund, array $data): bool
    {
        return $fund->update($data);
    }
}
