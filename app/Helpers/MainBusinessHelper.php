<?php

namespace App\Helpers;
trait MainBusinessHelper
{
    public function mainbusiness_datatable($data, $member)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $member,
            'can_edit' => $member->can('mainbusiness.edit'),
            'can_show' => $member->can('mainbusiness.view'),
            'can_delete' => $member->can('mainbusiness.delete'),
            'can_approve' => $member->can('mainbusiness.approve'),
            'can_multi_create' => $member->can('mainbusiness.create'),
            'can_mass_destroy' => $member->can('mainbusiness.mass_destroy'),
        ]);
    }
}
