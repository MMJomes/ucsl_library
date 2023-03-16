<?php

namespace App\Exports;

use App\Models\EventCategory;
use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromQuery;

class ExportCategoryList implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return EventCategory::query()->select(
            'name'
        );
    }

    public function headings(): array
    {
        return [
            'Name',
        ];
    }
}
