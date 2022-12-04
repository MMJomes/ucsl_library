<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{

    use  HasFactory, Sluggable;

    protected $table = 'events';
    protected $fillable = [
        'event_categories_id',
        'name',
        'location',
        'description',
        'map',
        'from_date',
        'to_date',
        'from_time',
        'to_time',
        'sort',
        'status',
        'createdate',
        'updatedate',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function eventcategory()
    {
        return $this->belongsTo(EventCategory::class, 'event_categories_id', 'id');
    }
}
