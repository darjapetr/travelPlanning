<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Show 'Activities' page.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $activities = Activity::with('images')->inRandomOrder()->get();
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
}
