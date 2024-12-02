<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    /**
     * Show 'Accommodation' page.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('accommodation');
    }
}
