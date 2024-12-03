<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_en',
        'name_lt',
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
     * Link images with Activity instances
     *
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
