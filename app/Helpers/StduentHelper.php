<?php

namespace App\Helpers;


trait StduentHelper
{
    public function Stduent_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('stduent.edit'),
            'can_show' => $bizType->can('stduent.view'),
            'can_delete' => $bizType->can('stduent.delete'),
            'can_approve' => $bizType->can('stduent.edit'),
            'can_approve' => $bizType->can('stduent.edit'),
        ]);
    }
}
