<?php

namespace App\Http\Controllers;

use App\Models\Online;
use App\Models\Translate;
use App\Models\Visit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $visits = Visit::all()->count();
        $online = Online::all()->count();
        $translates = Translate::paginate(5);

        return view('pages.dashboard', compact(
            'visits',
            'online',
            'translates'
        ));
    }
}