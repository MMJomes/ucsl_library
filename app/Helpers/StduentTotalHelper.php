<?php

namespace App\Helpers;


trait StduentTotalHelper
{
    public function Stduent_Total_datatable($data, $bizType,$totals)
    {
        return json_encode([
            'data' => $data,
            'total'=>$totals,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('author.edit'),
            'can_show' => $bizType->can('author.view'),
            'can_delete' => $bizType->can('author.delete'),
            'can_approve' => $bizType->can('author.edit'),
        ]);
    }
}
