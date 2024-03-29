<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class EventCategory extends Model
{

    use  HasFactory, Sluggable;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'code',
        'createdat',
        'updatedat',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'code'
            ]
        ];
    }
}
