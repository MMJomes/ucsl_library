<?php

namespace App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StdClass extends Model
{
    use  HasFactory;

    protected $fillable = [
        'studentclass',
    ];


}
