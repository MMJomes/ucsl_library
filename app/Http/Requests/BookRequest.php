<?php

namespace App\Http\Requests;

use App\Helpers\ImageHelper;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    use ImageHelper;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "titlename" => 'required',
        ];
    }


    public function messages()
    {
        return [
            "titlename" => 'Title Number is Required',
        ];
    }
}
