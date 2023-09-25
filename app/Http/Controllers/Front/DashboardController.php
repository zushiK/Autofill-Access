<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Laravel\Prompts\error;

class DashboardController extends Controller
{

    public function index()
    {
        $hello = 'Hello World from Inertia';
        return Inertia::render('Dashboard', [
            'name' => $hello,
        ]);
    }
}
