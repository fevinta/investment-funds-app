<?php

namespace App\Listeners;

use App\Events\DuplicateFundWarningEvent;
use App\Mail\DuplicateFundWarningMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendDuplicateFundWarningNotification
{
    public function handle(DuplicateFundWarningEvent $event): void
    {
        User::all()->each(fn(User $user) => Mail::to($user)->send(
            new DuplicateFundWarningMail($event->fund, $event->duplicates)
        ));
    }
}
