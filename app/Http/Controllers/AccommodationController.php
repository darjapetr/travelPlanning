<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    /**
     * Show 'Accommodation' page.
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $query = Accommodation::with('images');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('country_en', 'like', "%{$search}%")
                    ->orWhere('country_lt', 'like', "%{$search}%")
                    ->orWhere('city_en', 'like', "%{$search}%")
                    ->orWhere('city_lt', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $accommodations = $query->inRandomOrder()->get();
        return view('accommodation', compact('accommodations'));
    }

    /**
     * Show one accommodations info page.
     *
     * @param $id
     * @return View|Factory|Application
     */
    public function show($id): View|Factory|Application
    {
        $accommodation = Accommodation::with('images')->findOrFail($id);
        return view('accommodations.show', compact('accommodation'));
    }

    /**
     * Show accommodations creating form.
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('accommodations.form');
    }

    /**
     * Create new accommodations.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'city_en' => 'required|string|max:255',
            'city_lt' => 'required|string|max:255',
            'country_en' => 'required|string|max:255',
            'country_lt' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:hotel,apartments,glamping',
            'price' => 'required|numeric|min:0',
            'description_en' => 'nullable|string',
            'description_lt' => 'nullable|string',
            'images.*' => 'nullable|image',
        ]);

        $accommodation = Accommodation::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('accommodation', 'public');
                $accommodation->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('accommodation')->with('success', 'Accommodation created successfully!');
    }

    /**
     * Show accommodations editing form.
     *
     * @param Accommodation $accommodation
     * @return View|Factory|Application
     */
    public function edit(Accommodation $accommodation): View|Factory|Application
    {
        return view('accommodations.form', compact('accommodation'));
    }

    /**
     * Update selected accommodations.
     *
     * @param Request $request
     * @param Accommodation $accommodation
     * @return RedirectResponse
     */
    public function update(Request $request, Accommodation $accommodation): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'city_en' => 'required|string|max:255',
            'city_lt' => 'required|string|max:255',
            'country_en' => 'required|string|max:255',
            'country_lt' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:hotel,apartments,glamping',
            'price' => 'required|numeric|min:0',
            'description_en' => 'nullable|string',
            'description_lt' => 'nullable|string',
            'images.*' => 'nullable|image',
        ]);

        $accommodation->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('accommodation', 'public');
                $accommodation->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('accommodation')->with('success', 'Accommodation updated successfully!');
    }

    /**
     * Delete selected accommodations.
     *
     * @param Accommodation $accommodation
     * @return RedirectResponse
     */
    public function destroy(Accommodation $accommodation): RedirectResponse
    {
        $accommodation->delete();
        return redirect()->route('accommodation')->with('success', 'Accommodation deleted successfully!');
    }
}
