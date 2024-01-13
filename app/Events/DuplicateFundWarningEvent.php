<?php

namespace App\Events;

use App\Models\Fund;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DuplicateFundWarningEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Fund $fund, public Collection $duplicates)
    {
        //
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('duplicate-fund-warning'),
        ];
    }
}
