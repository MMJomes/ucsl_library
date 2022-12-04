<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventImageRequest extends FormRequest
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
            'events_id' =>'required',
            'image' => 'required',
            'createdat' => 'nullable',
            'updatedat' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'events_id' => 'ID is required',
            'image' => 'Image is required',
            'createdat' => 'nullable',
            'updatedat' => 'nullable',
        ];
    }
}
