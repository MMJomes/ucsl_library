<?php

namespace App\Repositories\Backend\Interf;

use App\Models\EventCategory;
use App\Repositories\BaseRepository;

class  EventCategoryRepository extends BaseRepository
{
    public function model()
    {
        return EventCategory::class;
    }
}
