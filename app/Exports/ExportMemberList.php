<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromQuery;

class ExportMemberList implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Member::query()->select(
            'batch_no',
            'year',
            'roll_no',
            'name',
            'dob',
            'qualification',
            'occupation',
            'departement',
            'office_phone',
            'office_address',
            'home_phone',
            'resident',
            'mobile',
            'email',
            'status',
            'password',
            'username'
        );
    }

    public function headings(): array
    {
        return [
            'Batch No',
            'Year',
            'Roll No',
            'Name',
            'DOB',
            'Qualification',
            'Occupation',
            'Departement',
            'Office Phone',
            'Office Address',
            'Home Phone',
            'Resident',
            'Mobile',
            'Email',
            'Status',
            'Password',
            'User Name'
        ];
    }
}
