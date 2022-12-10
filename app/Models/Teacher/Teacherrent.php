<?php

namespace App\Models\Teacher;

use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Teacherrent extends Model
{
    use  HasFactory, Notifiable;

    protected $table = 'teacherrents';
    protected $fillable = [
        'books_id',
        'teachers_id',
        'startdate',
        'enddate',
        'remark',
        'rentstatus',
        'status',
        'numberofbook',
        'requesttatus',
        'approvetatus',

    ];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teachers_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Books::class, 'books_id', 'id');
    }
}
