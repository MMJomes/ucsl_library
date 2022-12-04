<?php

namespace App\Repositories\Backend\Interf;

use App\Models\EventImage;
use App\Repositories\BaseRepository;

class  EventImageRepository extends BaseRepository
{
    public function model()
    {
        return EventImage::class;
    }
}
