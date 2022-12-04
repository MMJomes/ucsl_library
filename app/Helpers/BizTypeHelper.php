<?php

namespace App\Helpers;


trait BizTypeHelper
{
    public function biztype_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('bizcategory.edit'),
            'can_show' => $bizType->can('bizcategory.view'),
            'can_delete' => $bizType->can('bizcategory.delete'),
            'can_approve' => $bizType->can('bizcategory.edit'),
        ]);
    }
}
