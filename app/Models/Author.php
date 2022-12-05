<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Author extends Model
{

    use  HasFactory, Sluggable;

    //protected $table = 'authors';
    protected $fillable = [
        'categories_id',
        'name',
        'createdat',
        'updatedat',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'categories_id', 'id');
    }
}
