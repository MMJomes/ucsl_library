<?php

namespace App\Exports;

use App\Models\Books;
use App\Models\Member;
use App\Models\Stduent\Stduent;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromQuery;

class StduentExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Stduent::query()->select(
            'std_classes_id',
            'rollno',
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
            'Class Name',
            'Roll No',
            'Stduent Name',
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
