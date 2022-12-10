<?php

namespace App\Exports;

use App\Models\Teacher\Teacher;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromQuery;

class StaffExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Teacher::query()->select(
            'departements_id',
            'name',
            'image',
            'email',
            'phoneNo',
            'Address',
            'totalNoOfBooks',
            'totalNoOfreturn',
            'status',
        );
    }

    public function headings(): array
    {
        return [
            'Departement Name',
            'Staff Name',
            'Image',
            'Email',
            'Phone Number',
            'Address',
            'TotalNoOfBooks',
            'TotalNoOfReturnBook',
            'Status',
        ];
    }
}
