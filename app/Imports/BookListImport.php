<?php

namespace App\Imports;

use App\Jobs\AddNewBookMailServiceJob;
use App\Models\Books;
use App\Models\Setting;
use App\Models\Stduent\Stduent;
use App\Models\Teacher\Teacher;
use App\Notifications\SendEmail;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BookListImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {

        $sned_email_to_new_book =  Setting::where('key', 'sned_email_to_new_book')->first();
        $start_time = $row['date'];
        $start_times = ($start_time - 25569) * 86400;
        $date = gmdate("Y-m-d H:i:s", $start_times);
        $authorname =$row['author_name'];
        if($authorname){
            $authorName =$row['author_name'];
        }else{
            $authorName =null;
        }
        $categoriesname =$row['category_number'];
        if($categoriesname){
            $categoryName =$row['category_number'];
        }else{
            $categoryName =null;
        }
        Books::create([
            'categories_id' => $categoryName,
            'authors_id' =>  $authorName,
            'titlename' => $row['title_number'],
            'date' => $date,
            'bookname' => $row['book_name'],
            'produceyear' => $row['produce_year'],
            'edtion' => $row['edtion'],
            'price' => $row['price'],
            'availablereason' => $row['available_reason'],
            'remark' => $row['remark'],
            'publishername' => $row['publisher_name'],

        ]);
        if ($sned_email_to_new_book->value == ON ) {
            if ($sned_email_to_new_book->value == ON) {
                Stduent::where('status', ON)->get()->each(function ($stdeunt) {
                    if ($stdeunt->email != null) {
                        $stdeunt->notify(new SendEmail($stdeunt->name));
                    }
                });
                Teacher::where('status', ON)->get()->each(function ($stf) {
                    if ($stf->email != null) {
                        $stf->notify(new SendEmail($stf->name));
                    }
                });
            }
            // ContactMailServiceJob::dispatch($userfullname, $pwd, $yucontact->id);
        }
    }

    public function rules(): array
    {
        return [
            'date' => 'required',
        ];
    }
}
