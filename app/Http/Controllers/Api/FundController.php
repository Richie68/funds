<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FundRequest;
use App\Models\Fund;
use App\Services\FundService;

class FundController extends Controller
{
    public function update(Fund $fund, FundRequest $request)
    {
        return $fund->update([
            'name' => $request->name,
            'start' => $request->start,
            'manager_uuid' => $request->manager_uuid,
        ]);
    }

    public function store(FundRequest $request, FundService $service)
    {
        $fund = Fund::create($request->validated());

        $service->checkForDuplicates($fund);

        return to_route('fund.show', $fund->uuid);
    }
}
