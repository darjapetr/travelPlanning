<?php

namespace App\Http\Controllers;

use App\Models\Destination;
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
        $destinations = Destination::with('images')->inRandomOrder()->get();
        return view('destinations', compact('destinations'));
    }

    /**
     * Show one destination info page.
     *
     * @param $id
     * @return View|Factory|Application
     */
    public function show($id): View|Factory|Application
    {
        $destination = Destination::with('images')->findOrFail($id);
        return view('destinations.show', compact('destination'));
    }

}
