<?php

namespace App\Models\Stduent;

use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bookrent extends Model
{
    use  HasFactory,Notifiable;

    protected $table = 'bookrents';
    protected $fillable = [
        'books_id',
        'stduents_id',
        'startdate',
        'enddate',
        'remark',
        'status',
        'numberofbook',
    ];


    public function stduent()
    {
        return $this->belongsTo(Stduent::class, 'stduents_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Books::class, 'books_id', 'id');
    }
}
