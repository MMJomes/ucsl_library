<?php

namespace App\Helpers;


trait StduentClsassHelper
{
    public function StduentClass_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('stduentCalss.create'),
            'can_show' => $bizType->can('stduentCalss.view'),
            'can_delete' => $bizType->can('stduentCalss.delete'),
            'can_approve' => $bizType->can('stduentCalss.edit'),
        ]);
    }
}
