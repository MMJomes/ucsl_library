<?php

namespace App\Imports;

use App\Jobs\ContactMailServiceJob;
use App\Models\Books;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BookListImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {

        $start_time = $row['date'];
        $start_times = ($start_time - 25569) * 86400;
        $date = gmdate("Y-m-d H:i:s", $start_times);

        Books::create([
            'categories_id' => $row['category_name'],
            'authors_id' =>  $row['author_name'],
            'titlename' => $row['title_number'],
            'date' => $date,
            'bookname' => $row['book_name'],
            'producetime' => $row['produce_time'],
            'edtion' => $row['edtion'],
            'price' => $row['price'],
            'availablereason' => $row['available_reason'],
            'remark' => $row['remark'],
            'publishername' => $row['publisher_name'],

        ]);
    }

    public function rules(): array
    {
        return [
            'date' => 'required',
        ];
    }
}
