<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripController extends Controller
{
    /**
     * Display a listing of trips for the authenticated user.
     *
     * @return View
     */
    public function index(): View
    {
        $trips = auth()->user()->trips()->get();
        return view('trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new trip.
     *
     * @return View
     */
    public function create(): View
    {
        return view('trips.create');
    }

    /**
     * Store a newly created trip in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $trip = auth()->user()->trips()->create($request->all());

        return redirect()->route('trips.index')->with('success', 'Trip created successfully!');
    }

    /**
     * Show the form for editing the specified trip.
     *
     * @param Trip $trip
     * @return View
     */
    public function edit(Trip $trip): View
    {
        return view('trips.edit', compact('trip'));
    }

    /**
     * Update the specified trip in storage.
     *
     * @param Request $request
     * @param Trip $trip
     * @return RedirectResponse
     */
    public function update(Request $request, Trip $trip): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $trip->update($request->all());

        return redirect()->route('trips.index')->with('success', 'Trip updated successfully!');
    }

    /**
     * Remove the specified trip from storage.
     *
     * @param Trip $trip
     * @return RedirectResponse
     */
    public function destroy(Trip $trip): RedirectResponse
    {
        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully!');
    }
}
