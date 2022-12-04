<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Event;
use App\Repositories\BaseRepository;

class  EventRepository extends BaseRepository
{
    public function model()
    {
        return Event::class;
    }
}
