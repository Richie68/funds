<?php

namespace App\Services;

use App\Events\Funds\NewFundCreatedWithDuplicateFunds;
use App\Models\Fund;

class FundService
{
    public function checkForDuplicates(Fund $fund): void
    {
        $duplicates = Fund::with('manager', 'aliases')
            ->where('name', $fund->name)
            ->get();

        if ($duplicates->count() > 0) {
            event(new NewFundCreatedWithDuplicateFunds($duplicates));
        }

    }
}
