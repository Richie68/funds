<?php

namespace App\Listeners\Alias;

use App\Events\Alias\NewAliasCreatedWithDuplicateNames;
use App\Mail\DuplicateAliasNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DuplicateAliasWarning
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
    public function handle(NewAliasCreatedWithDuplicateNames $event): void
    {
        \Mail::to('admin@example.com')
            ->send(new DuplicateAliasNotification($event->aliases));
    }
}
