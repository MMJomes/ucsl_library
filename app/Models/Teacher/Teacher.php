<?php

namespace App\Models\Teacher;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Teacher extends Model
{
    use  HasFactory, Sluggable,Notifiable;
    protected $table = 'teachers';
    protected $fillable = [
        'departements_id',
        'name',
        'image',
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
    public function department()
    {
        return $this->belongsTo(Departement::class, 'departements_id', 'id');
    }
}
