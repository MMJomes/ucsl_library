<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BizTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            return [
                'name' => 'required',
                'keyword' => 'required',
                'description' => 'required',
                'createdat' => 'required|date',
                'updatedat' => 'required|date',
            ];

    }
    public function messages()
    {
        return [

            'batchno' => 'Batch No is required',

            'name' => 'Name is required',
            'keyword' => 'Keyword is required',
            'description' => 'Description is required',
            'createdat' => 'Created Date is required',
            'updatedat' => 'Updated Date is required',
        ];
    }
}
