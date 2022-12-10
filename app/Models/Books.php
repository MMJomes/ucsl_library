<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Books extends Model
{
    protected $table = 'books';
    use HasFactory,Notifiable,Sluggable;
    protected $fillable = [
        'categories_id',
        'authors_id',
        'titlename',
        'date',
        'bookname',
        'produceyear',
        'edtion',
        'price',
        'availablereason',
        'remark',
        'availablebook',
        'totalbook',
        'createdat',
        'bookpdflink',
        'publishername',
        'updatedat',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'bookname'
            ]
        ];
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'authors_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'categories_id', 'id');
    }
}
