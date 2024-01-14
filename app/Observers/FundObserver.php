<?php

namespace App\Observers;

use App\Jobs\CheckForDuplicatesFundJob;
use App\Models\Fund;

class FundObserver
{
    public function created(Fund $fund): void
    {
        dispatch(new CheckForDuplicatesFundJob($fund));
    }

    public function updated(Fund $fund): void
    {
        if ($fund->isDirty('name')) {
            dispatch(new CheckForDuplicatesFundJob($fund));
        }
    }
}
