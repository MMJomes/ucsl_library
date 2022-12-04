<?php

namespace App\Helpers;
trait SideBusinessHelper
{
    public function sidebusiness_datatable($data, $member)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $member,
            'can_edit' => $member->can('sidebusiness.edit'),
            'can_show' => $member->can('sidebusiness.view'),
            'can_delete' => $member->can('sidebusiness.delete'),
            'can_approve' => $member->can('sidebusiness.approve'),
            'can_multi_create' => $member->can('sidebusiness.create'),
            'can_mass_destroy' => $member->can('sidebusiness.mass_destroy'),
        ]);
    }
}
