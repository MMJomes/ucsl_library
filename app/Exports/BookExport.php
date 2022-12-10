<?php

namespace App\Exports;

use App\Models\Books;
use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromQuery;

class BookExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Books::query()->select(
            'categories_id',
            'authors_id',
            'titlename',
            'date',
            'bookname',
            'produceyear',
            'edtion',
            'price',
            'availablereason',
            'remark',
            'availablebook',
            'totalbook',
        );
    }

    public function headings(): array
    {
        return [
            'Category Name',
            'Author Name',
            'Title No',
            'Date',
            'Book Name',
            'Produce Year',
            'Edtion',
            'Price',
            'Available Reason',
            'Remark',
            'Total Book',
            'Available Book Count',
        ];
    }
}
