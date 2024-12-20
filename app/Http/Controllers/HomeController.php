<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show 'Home' page.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $destinations = Destination::with('images')->inRandomOrder()->limit(3)->get();
        return view('home', compact('destinations'));
    }
}
