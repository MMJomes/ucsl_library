<?php

namespace App\Helpers;


trait StaffBookPreRentHelper
{
    public function StaffBookPReRent_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('StaffBookPreRent.edit'),
            'can_show' => $bizType->can('StaffBookPreRent.view'),
            'can_delete' => $bizType->can('StaffBookPreRent.delete'),
            'can_approve' => $bizType->can('StaffBookPreRent.edit'),
            'continue' => $bizType->can('StaffBookPreRent.continue'),
            'rentStatus' => $bizType->can('StaffBookPreRent.rentStatus'),
        ]);
    }
}
