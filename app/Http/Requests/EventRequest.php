<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'event_categories_id' => 'required',
            'name'  => 'required',
            'location'  => 'required',
            'description'  => 'required',
            'map'  => 'required',
            'from_date'  => 'required',
            'to_date'  => 'required',
            'from_time'  => 'required',
            'to_time'  => 'required',
            'createdate' => 'nullable',
            'updatedate' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'event_categories_id' => 'ID is required',
            'name'  => 'Name is required',
            'location'  => 'Location is required',
            'description'  => 'Description is required',
            'map'  => 'Map is required',
            'from_date'  => 'From Date is required',
            'to_date'  => 'To Date is required',
            'from_time'  => 'From Time is required',
            'to_time'  => 'To Time is required',
            'createdate' => 'nullable',
            'updatedate' => 'nullable',
        ];
    }
}
