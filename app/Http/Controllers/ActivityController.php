<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Show 'Activities' page.
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $query = Activity::with('images');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_lt', 'like', "%{$search}%")
                    ->orWhere('country_en', 'like', "%{$search}%")
                    ->orWhere('country_lt', 'like', "%{$search}%")
                    ->orWhere('city_en', 'like', "%{$search}%")
                    ->orWhere('city_lt', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $activities = $query->inRandomOrder()->get();
        return view('activities', compact('activities'));
    }

    /**
     * Show one destination info page.
     *
     * @param $id
     * @return View|Factory|Application
     */
    public function show($id): View|Factory|Application
    {
        $activity = Activity::with('images')->findOrFail($id);
        return view('activities.show', compact('activity'));
    }

    /**
     * Show activity creating form.
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('activities.form');
    }

    /**
     * Create new activity.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name_lt' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'city_en' => 'required|string|max:255',
            'city_lt' => 'required|string|max:255',
            'country_en' => 'required|string|max:255',
            'country_lt' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:museum,restaurants,entertainment',
            'price' => 'required|numeric|min:0',
            'description_en' => 'nullable|string',
            'description_lt' => 'nullable|string',
            'images.*' => 'nullable|image',
        ]);

        $activity = Activity::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('activities', 'public');
                $activity->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('activities')->with('success', 'Activity created successfully!');
    }

    /**
     * Show activity editing form.
     *
     * @param Activity $activity
     * @return View|Factory|Application
     */
    public function edit(Activity $activity): View|Factory|Application
    {
        return view('activities.form', compact('activity'));
    }

    /**
     * Update selected acitivity.
     *
     * @param Request $request
     * @param Activity $activity
     * @return RedirectResponse
     */
    public function update(Request $request, Activity $activity): RedirectResponse
    {
        $data = $request->validate([
            'name_lt' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'city_en' => 'required|string|max:255',
            'city_lt' => 'required|string|max:255',
            'country_en' => 'required|string|max:255',
            'country_lt' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:museum,restaurants,entertainment',
            'price' => 'required|numeric|min:0',
            'description_en' => 'nullable|string',
            'description_lt' => 'nullable|string',
            'images.*' => 'nullable|image',
        ]);

        $activity->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('activities', 'public');
                $activity->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('activities')->with('success', 'Activity updated successfully!');
    }

    /**
     * Delete selected activity.
     *
     * @param Activity $activity
     * @return RedirectResponse
     */
    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();
        return redirect()->route('activities')->with('success', 'Activity deleted successfully!');
    }
}
