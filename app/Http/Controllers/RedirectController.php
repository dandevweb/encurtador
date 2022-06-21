<?php

namespace App\Http\Controllers;

use App\Models\Translate;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index(string $uri)
    {
        $translate = Translate::where('new_link', route('url.redirect', ['uri' => $uri]))->first();

        if ($translate) {
            $translate->clicks = $translate->clicks + 1;
            $translate->save();

            return redirect()->away('https://'. $translate->link);
        }

        return view('pages.404');

    }
}