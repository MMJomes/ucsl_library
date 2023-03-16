<?php

namespace App\Models\Stduent;

use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PreRequest extends Model
{
    use  HasFactory,Notifiable;

    protected $table = 'pre_requests';
    protected $fillable = [
        'books_id',
        'stduents_id',
        'remark',
        'status',
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
