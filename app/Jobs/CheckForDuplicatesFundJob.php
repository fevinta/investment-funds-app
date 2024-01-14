<?php

namespace App\Jobs;

use App\Events\DuplicateFundWarningEvent;
use App\Interfaces\FundRepositoryInterface;
use App\Models\Fund;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckForDuplicatesFundJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private Fund $fund)
    {
        //
    }

    public function handle(FundRepositoryInterface $fundRepository): void
    {
        $duplicates = $fundRepository->getAllPossibleDuplicates($this->fund);

        if ($duplicates->isNotEmpty()) {
            event(new DuplicateFundWarningEvent($this->fund, $duplicates));
        }
    }
}
