<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Show 'Destinations' page.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('destinations');
    }
}
