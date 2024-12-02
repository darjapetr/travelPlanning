<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
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
        $accommodations = Accommodation::with('images')->inRandomOrder()->get();
        return view('accommodation', compact('accommodations'));
    }

    /**
     * Show one accommodation info page.
     *
     * @param $id
     * @return View|Factory|Application
     */
    public function show($id): View|Factory|Application
    {
        $accommodation = Accommodation::with('images')->findOrFail($id);
        return view('accommodation.show', compact('accommodation'));
    }
}
