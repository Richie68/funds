<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FundController extends Controller
{
    public function show(Fund $fund)
    {
        return Inertia::render('Funds/Show', [
            'fund' => $fund->load('manager', 'aliases', 'companies')
        ]);
    }

    public function create()
    {
        return Inertia::render('Funds/Create');
    }
}
