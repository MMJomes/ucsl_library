<?php

namespace App\Http\Requests;

use App\Helpers\ImageHelper;
use Illuminate\Foundation\Http\FormRequest;

class MainBusinessRequest extends FormRequest
{
    use ImageHelper;




    public function messages()
    {
        return [
            'business_type_id' => 'nullable',
            'name' => 'Name is required',
            'keyword' => 'Keyword is required',
            'description' => 'Description is required',
            'social_link' => 'Social Link is required',
            //'business_images' => 'Business Image is required',
            'business_address' => 'Business  Address is required',
        ];
    }
    public function rules()
    {
        return [

            'business_type_id' => 'nullable',
            'name' => 'required',
            'keyword' => 'required',
            'description' => 'required',
            'social_link' => 'required',
            //'business_images' => 'required',
            'business_address' => 'required',

        ];
    }
}
