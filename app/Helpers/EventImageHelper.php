<?php

namespace App\Helpers;


trait EventImageHelper
{
    public function eventimage_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('eventimage.edit'),
            'can_show' => $bizType->can('eventimage.view'),
            'can_delete' => $bizType->can('eventimage.delete'),
            'can_approve' => $bizType->can('eventimage.edit'),
        ]);
    }
}
