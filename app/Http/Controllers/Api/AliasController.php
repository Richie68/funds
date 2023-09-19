<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alias;
use App\Models\Fund;
use App\Services\AliasService;
use Str;

class AliasController extends Controller
{
    public function index()
    {
        return Fund::with('manager', 'aliases')->latest()->get();
    }

    public function update(Alias $alias)
    {
        if ($alias->update(['name' => request('name')])) {
            return $alias->fresh();
        }

        return 2;
    }

    public function destroy(Alias $alias, Fund $fund)
    {
        $fund->aliases()->detach($alias->id);

        $alias->delete();

        return 1;
    }

    public function store(Fund $fund, AliasService $service)
    {
        $alias = Alias::create([
            'name' => request('name'),
            'uuid' => Str::uuid(),
        ]);

        $fund->aliases()->attach($alias->id);

        $service->checkForDuplicated($alias->name);

        return 1;
    }
}
