<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules()
    {
        $this->role != null ? $id = $this->role->id : $id = '';
        return [
            "name" => "required|string|unique:roles,name,".$id,
            "permissions" => "required|array",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Role Name is required',
            'name.string' => 'Role Name must be string',
            'name.unique' => 'Role Name is already exist',
            'permissions.required' => 'Permissions are required',
            'permissions.array' => 'Permissions must be array',
        ];
    }
}
