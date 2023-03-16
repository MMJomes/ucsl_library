<?php

namespace App\Helpers;


trait BookPreRentHelper
{
    public function BookPReRent_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('stduentBookPreRent.edit'),
            'can_show' => $bizType->can('stduentBookPreRent.view'),
            'can_delete' => $bizType->can('stduentBookPreRent.delete'),
            'can_approve' => $bizType->can('stduentBookPreRent.edit'),
            'continue' => $bizType->can('stduentBookPreRent.continue'),
            'rentStatus' => $bizType->can('stduentBookPreRent.rentStatus'),
        ]);
    }
}
