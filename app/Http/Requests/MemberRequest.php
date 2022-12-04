<?php

namespace App\Http\Requests;

use App\Helpers\ImageHelper;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    use ImageHelper;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
            return [
                'batch_no' => 'required',
                'year' => 'required',
                 'roll_no' => 'required',
                'name' => 'required',
                'dob' => 'required|date',
                'qualification' => 'required',
                'occupation' => 'required',
                'departement' => 'required',
                'office_phone' => 'required',
                'office_address' => 'required',
                'home_phone' => 'required|numeric',
                'resident' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'required'
            ];

        }


    public function messages()
    {
        return [

            'batchno' => 'Batch No is required',
            'year' => 'Year is required',
            'rollno ' => 'Roll No is required',
            'name' => 'Name is required',
            'dob' => 'DOB is required',
            'qualification' => 'Qualification is required',
            'occupation' => 'Occupation is required',
            'departement' => 'Departement is required',
            'office_phone' => 'Office Phone is required',
            'office_address' => 'Office Address is required',
            'home_phone' => 'Home Phone is required',
            'resident' => 'Resident is required',
            'mobile' => 'Mobile is required',
            'email' => 'The Email is required'
        ];
    }

}
