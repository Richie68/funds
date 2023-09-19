<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManagerController extends Controller
{
    public function index()
    {
        return Inertia::render('Managers/Index', [
            'managers' => Manager::with('funds')->get()
        ]);
    }
}
