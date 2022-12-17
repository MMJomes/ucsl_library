<?php

namespace App\Helpers;


trait DepartmentHelper
{
    public function Department_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('staffDepart.create'),
            'can_show' => $bizType->can('staffDepart.view'),
            'can_delete' => $bizType->can('staffDepart.delete'),
            'can_approve' => $bizType->can('staffDepart.edit'),
        ]);
    }
}
