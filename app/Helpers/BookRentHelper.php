<?php

namespace App\Helpers;


trait BookRentHelper
{
    public function BookRent_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('stduentBookRent.edit'),
            'can_show' => $bizType->can('stduentBookRent.view'),
            'can_delete' => $bizType->can('stduentBookRent.delete'),
            'can_approve' => $bizType->can('stduentBookRent.edit'),
            'continue' => $bizType->can('stduentBookRent.continue'),
            'rentStatus' => $bizType->can('stduentBookRent.rentStatus'),
        ]);
    }
}
