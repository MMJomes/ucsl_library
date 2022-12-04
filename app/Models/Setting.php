<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting_tbl';
    protected $fillable = [
        'key',
        'value',
        'type',
    ];
}
