<?php

namespace App\Listeners\Funds;

use App\Events\Funds\NewFundCreatedWithDuplicateFunds;
use App\Mail\DuplicateFundsNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DuplicateFundWarning
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewFundCreatedWithDuplicateFunds $event): void
    {
        \Mail::to('admin@example.com')
            ->send(new DuplicateFundsNotification($event->funds));
    }
}
