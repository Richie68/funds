<?php

namespace App\Services;

use App\Events\Alias\NewAliasCreatedWithDuplicateNames;
use App\Models\Alias;

class AliasService
{
    public function checkForDuplicated($aliasName): void
    {
        $duplicates = Alias::with('funds.manager')->where('name', $aliasName)->get();

        if ($duplicates->count() > 0) {
            event(new NewAliasCreatedWithDuplicateNames($duplicates));
        }
    }
}
