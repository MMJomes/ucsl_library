<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SideBusiness extends Model
{
    protected $table = 'side_businesses';

    use HasFactory, Sluggable;
    protected $fillable = [
        'biz_type_tbl_id',
        'member_tbl_id',
        'name',
        'keyword',
        'description',
        'business_image',
        'social_link',
        'business_pdf',
        'business_reg',
        'business_address',
        'business_phone',
        'created_by',
        'updated_by',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_tbl_id', 'id');
    }
    public function businessType()
    {
        return $this->belongsTo(BizType::class, 'biz_type_tbl_id', 'id');
    }
}
