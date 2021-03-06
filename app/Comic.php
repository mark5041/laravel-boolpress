<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
        'thumb',
        'price',
        'sale_date',
        'type',
        'slug',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }



    public function artist()
    {
        return $this->belongsToMany('App\Artist');
    }

    public function writer()
    {
        return $this->belongsToMany('App\Writer');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createSlug($title)
    {
        $slug = Str::slug($title, '-');

        $oldComic = Comic::where('slug', $slug)->first();

        $counter = 0;
        while ($oldComic) {
            $newSlug = $slug . '-' . $counter;
            $oldComic = Comic::where('slug', $slug)->first();
            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;
    }
}
