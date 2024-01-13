<?php

namespace App\Observers;

use App\Events\DuplicateFundWarningEvent;
use App\Interfaces\FundRepositoryInterface;
use App\Models\Fund;

class FundObserver
{
    public function __construct(
        private FundRepositoryInterface $fundRepository
    ) {
        //
    }

    public function created(Fund $fund): void
    {
        $duplicates = $this->fundRepository->getAllPossibleDuplicates($fund);

        if ($duplicates->isNotEmpty()) {
            event(new DuplicateFundWarningEvent($fund, $duplicates));
        }
    }
}
