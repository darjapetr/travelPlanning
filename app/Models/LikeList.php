<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;

class LikeList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_type', 'item_id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        Relation::morphMap([
            'accommodation' => Accommodation::class,
            'activity' => Activity::class,
            'destination' => Destination::class,
        ]);
    }

    /**
     * Link liked items with like list.
     *
     * @return MorphTo
     */
    public function item()
    {
        return $this->morphTo();
    }
}
