<?php

namespace App\Http\Controllers;

use App\Models\HomepageFeature;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $goodStuff = HomepageFeature::query()
            ->get()
            ->keyBy('slug');

        return view('home', compact('goodStuff'));
    }
}
