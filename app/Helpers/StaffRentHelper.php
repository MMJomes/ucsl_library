<?php

namespace App\Helpers;


trait StaffRentHelper
{
    public function StaffRent_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('staffBookRent.edit'),
            'can_show' => $bizType->can('staffBookRent.view'),
            'can_delete' => $bizType->can('staffBookRent.delete'),
            'can_approve' => $bizType->can('staffBookRent.edit'),
            'continue' => $bizType->can('staffBookRent.continue'),
            'rentStatus' => $bizType->can('staffBookRent.rentStatus'),
        ]);
    }
}
