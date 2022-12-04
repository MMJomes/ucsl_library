<?php

namespace App\Http\Requests;

use App\Helpers\ImageHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AdminRequest extends FormRequest
{
    use ImageHelper;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->admin) {
            // update rules
            return [
                'image' => 'nullable',
                'name' => 'required',
                'email' => 'required|email|unique:admins,email,' . $this->admin->id,
                'roles' => 'required',
            ];
        } else {
            // create rules
            return [
                'image' => 'nullable',
                'name' => 'required',
                'password' => 'required|confirmed|same:password_confirmation|min:5',
                'email' => 'required|email|unique:admins,email',
                'roles' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Confirm Password do not match',
            'password.same' => 'Password And Confirm Password must be same',
            'password.min' => 'Password must be greater than 4 characters',
            'email' => 'The Email is required',
            'email.email' => 'Email Format is invalid',
            'email.unique' => 'Email is already exist',
            'roles' => 'The Role is required',
        ];
    }

    public function validated(): array
    {
        if ($this->hasFile('image')) {
            $img_url =  $this->uploadImage($this->file('image'), 'admins');
            if ($this->input('old_img')) {
                $this->deleteImage($this->input('old_img'));
            }
        } else {
            if ($this->input('old_img')) {
                $img_url = $this->input('old_img');
            }
        }

        if ($this->has('password') && $this->filled('password')) {
            $password = Hash::make($this->input('password'));
            return array_merge(parent::validated(), ['password' => $password, 'image' => $img_url ?? '/assets/images/default-user.png']);
        }

        return array_merge(parent::validated(), ['image' => $img_url ?? '/assets/images/default-user.png']);
    }
}
