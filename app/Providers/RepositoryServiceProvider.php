<?php

namespace App\Providers;

use App\Interfaces\FundRepositoryInterface;
use App\Repositories\FundRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FundRepositoryInterface::class, FundRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
