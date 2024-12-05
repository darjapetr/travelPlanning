<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Show 'Destinations' page.
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $query = Destination::with('images');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('country_en', 'like', "%{$search}%")
                    ->orWhere('country_lt', 'like', "%{$search}%")
                    ->orWhere('city_en', 'like', "%{$search}%")
                    ->orWhere('city_lt', 'like', "%{$search}%");
            });
        }

        $destinations = $query->inRandomOrder()->get();
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

    /**
     * Show destination creating form.
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('destinations.form');
    }

    /**
     * Create new destination.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'city_en' => 'required|string|max:255',
            'city_lt' => 'required|string|max:255',
            'country_en' => 'required|string|max:255',
            'country_lt' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_lt' => 'required|string',
            'images.*' => 'nullable|image',
        ]);

        $destination = Destination::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('destinations', 'public');
                $destination->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('destinations')->with('success', 'Destination created successfully!');
    }

    /**
     * Show destination editing form.
     *
     * @param Destination $destination
     * @return View|Factory|Application
     */
    public function edit(Destination $destination): View|Factory|Application
    {
        return view('destinations.form', compact('destination'));
    }

    /**
     * Update selected destination.
     *
     * @param Request $request
     * @param Destination $destination
     * @return RedirectResponse
     */
    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $data = $request->validate([
            'city_en' => 'required|string|max:255',
            'city_lt' => 'required|string|max:255',
            'country_en' => 'required|string|max:255',
            'country_lt' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_lt' => 'required|string',
            'images.*' => 'nullable|image',
        ]);

        $destination->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('destinations', 'public');
                $destination->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('destinations')->with('success', 'Destination updated successfully!');
    }

    /**
     * Delete selected destination.
     *
     * @param Destination $destination
     * @return RedirectResponse
     */
    public function destroy(Destination $destination): RedirectResponse
    {
        $destination->delete();
        return redirect()->route('destinations')->with('success', 'Destination deleted successfully!');
    }


}
