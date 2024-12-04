<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Activity;
use App\Models\Destination;
use App\Models\LikeList;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeListController extends Controller
{
    /**
     * Show like list page.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $likelist = auth()->user()->likeLists()->get();

        $items = $likelist->map(function ($like) {
            switch ($like->item_type) {
                case 'destination':
                    return [
                        'type' => $like->item_type,
                        'model' => Destination::with('images')->find($like->item_id),
                    ];
                case 'accommodation':
                    return [
                        'type' => $like->item_type,
                        'model' => Accommodation::with('images')->find($like->item_id),
                    ];
                case 'activity':
                    return [
                        'type' => $like->item_type,
                        'model' => Activity::with('images')->find($like->item_id),
                    ];
                default:
                    return null;
            }
        })->filter();

        return view('likelist.index', compact('items'));
    }

    /**
     * Add an item to the like list.
     *
     * @param $type
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function like($type, $id): RedirectResponse
    {
        $model = $this->getModel($type);

        $item = $model::findOrFail($id);
        $exists = LikeList::where([
            'user_id' => auth()->id(),
            'item_type' => $type,
            'item_id' => $id,
        ])->exists();

        if (!$exists) {
            LikeList::create([
                'user_id' => auth()->id(),
                'item_type' => $type,
                'item_id' => $id,
            ]);
        }

        return redirect()->back()->with('success', ucfirst($type) . ' liked successfully!');
    }

    /**
     * Remove an item from the like list.
     *
     * @param $type
     * @param $id
     * @return RedirectResponse
     */
    public function unlike($type, $id): RedirectResponse
    {
        LikeList::where([
            'user_id' => auth()->id(),
            'item_type' => $type,
            'item_id' => $id,
        ])->delete();

        return redirect()->back()->with('success', ucfirst($type) . ' unliked successfully!');
    }

    /**
     * Get the model class for the item type.
     *
     * @param $type
     * @return string
     * @throws Exception
     */
    private function getModel($type): string
    {
        return match ($type) {
            'accommodation' => Accommodation::class,
            'activity' => Activity::class,
            'destination' => Destination::class,
            default => throw new Exception('Invalid item type'),
        };
    }
}
