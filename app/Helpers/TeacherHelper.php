<?php

namespace App\Helpers;


trait TeacherHelper
{
    public function Staff_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('staff.edit'),
            'can_show' => $bizType->can('staff.view'),
            'can_delete' => $bizType->can('staff.delete'),
            'can_approve' => $bizType->can('staff.edit'),
            'can_approve' => $bizType->can('staff.edit'),
        ]);
    }
}
