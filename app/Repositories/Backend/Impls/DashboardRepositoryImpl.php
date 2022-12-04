<?php

namespace App\Repositories\Backend\Impls;

use App\Repositories\Backend\Interf\DashboardRepository;
use Illuminate\Database\Eloquent\Collection;

class DashboardRepositoryImpl implements DashboardRepository
{
    public function getStatics(): array
    {
        $statics = [];

        return $statics;
    }
}
