<?php

namespace App\Models\Stduent;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Stduent extends Model
{

    use  HasFactory, Sluggable,Notifiable;

    protected $table = 'stduents';
    protected $fillable = [
        'std_classes_id',
        'name',
        'image',
        'rollno',
        'email',
        'phoneNo',
        'Address',
        'totalNoOfBooks',
        'totalNoOfreturn',
        'status',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function stdclass()
    {
        return $this->belongsTo(StdClass::class, 'std_classes_id', 'id');
    }
}

