<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AuthorListImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $categories_id =$row['categories_id'];
        $name =$row['name'];
         Author::create([
            'name' => $name,
            'categories_id' => $categories_id,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'categories_id' => 'required',
        ];
    }
}
