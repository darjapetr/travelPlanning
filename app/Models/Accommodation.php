<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Accommodation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city_en',
        'country_en',
        'description_en',
        'city_lt',
        'country_lt',
        'description_lt',
        'type',
        'price',
        'address',
    ];

    /**
     * Link images with Accommodation instances
     *
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Link like list with Accommodation instances.
     *
     * @return MorphMany
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(LikeList::class, 'item', 'item_type', 'item_id');
    }
}
