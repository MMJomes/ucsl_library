<?php

namespace App\Http\Requests;

use App\Helpers\ImageHelper;
use Illuminate\Foundation\Http\FormRequest;

class SideBusinessRequest extends FormRequest
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
            //'business_image' => 'Business Image is required',
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
            //'business_image' => 'required',
            'business_address' => 'required',

        ];
    }
    public function validated(): array
    {
        if ($this->hasFile('business_image')) {
            $img_url =  $this->uploadImage($this->file('business_image'), 'admins');
            if ($this->input('old_img')) {
                $this->deleteImage($this->input('old_img'));
            }
        } else {
            if ($this->input('old_img')) {
                $img_url = $this->input('old_img');
            }
        }
        return array_merge(parent::validated(), ['created_by' => auth()->user()->name, 'update_by' => auth()->user()->name, 'image' => $img_url ?? '/assets/images/default-user.png']);
}
}
