<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    protected $table = 'member_tbl';

    use HasFactory,Notifiable,Sluggable;
    protected $fillable = [
        'batch_no',
        'year',
        'roll_no',
        'name',
        'dob',
        'qualification',
        'occupation',
        'departement',
        'office_phone',
        'office_address',
        'home_phone',
        'resident',
        'mobile',
        'email',
        'status',
        'password',
        'username'
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
