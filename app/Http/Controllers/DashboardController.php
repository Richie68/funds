<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Database\Eloquent\Builder;
use Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $search = Request::input('search');
        $funds = Fund::query()
            ->with(['manager', 'aliases', 'companies'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereYear('start', $search)
                    ->orWhereHas('manager', function (Builder $query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
            })
            ->orderBy('name')
            ->get();

        return Inertia::render('Dashboard', [
            'funds' => $funds,
        ]);
    }
}
