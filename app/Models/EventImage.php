<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class EventImage extends Model
{

    use  HasFactory, Sluggable;

    protected $table = 'event_images';
    protected $fillable = [
        'events_id',
        'image',
        'status',
        'createdat',
        'updatedat',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'events_id'
            ]
        ];
    }
    public function event()
    {
        return $this->belongsTo(EventCategory::class, 'events_id', 'id');
    }
}
