<?php

namespace Modules\Konten\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;


class Anime extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'rating',
        'genre',
        'thumbnail',
        'banner',
        'status',
        'jadwal_release',
        'publish'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'genre' => 'array',
    ];

     protected $appends = [
        'url_thumbnail',
        'url_banner',
    ];

    public function getUrlThumbnailAttribute()
    {
        return (!empty($this->attributes['thumbnail'])) ? Storage::disk('public')->url('anime/thumbnail/'.$this->attributes['thumbnail']) : null;
    }

    public function getUrlBannerAttribute()
    {
        return (!empty($this->attributes['banner'])) ? Storage::disk('public')->url('anime/banner/'.$this->attributes['banner']) : null;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
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

    public function episode()
    {
        return $this->hasMany('Modules\Konten\Entities\Episode', 'anime_id');
    }
}
