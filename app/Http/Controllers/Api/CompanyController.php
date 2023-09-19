<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Fund;

class CompanyController extends Controller
{
    public function search()
    {
        $search = strtolower(request('search'));

        return Company::where('name', 'LIKE', '%' . $search . '%')->get();
    }

    public function update(Fund $fund, Company $company)
    {
        $fund->companies()->attach($company->id);

        return 1;
    }

    public function destroy(Company $company, Fund $fund)
    {
        $fund->companies()->detach($company->id);

        $company->delete();

        return 1;
    }
}
