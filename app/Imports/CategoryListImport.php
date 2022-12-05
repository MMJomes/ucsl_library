<?php

namespace App\Imports;

use App\Models\EventCategory;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoryListImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $name =$row['name'];
         EventCategory::create([
            'name' => $name,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}