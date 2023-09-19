<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function search()
    {
        $search = strtolower(request('search'));

        return Manager::where('name', 'LIKE', '%' . $search . '%')->get();
    }
}
