<?php

namespace App\Models\Teacher;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use  HasFactory, Sluggable;
    protected $table = 'departements';
    protected $fillable = [
        'stfdepartment',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'stfdepartment'
            ]
        ];
    }
}

