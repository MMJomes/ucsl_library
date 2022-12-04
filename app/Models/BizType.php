<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BizType extends Model
{

    use  HasFactory, Sluggable;

    protected $table = 'biz_type_tbl';
    use HasFactory;
    protected $fillable = [
        'name',
        'keyword',
        'description',
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
}
