<?php

namespace App\Helpers;
trait BookHelper
{
    public function booking_datatable($data, $member)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $member,
            'can_edit' => $member->can('book.edit'),
            'can_show' => $member->can('book.view'),
            'can_delete' => $member->can('book.delete'),
            'can_approve' => $member->can('book.approve'),
            'can_multi_create' => $member->can('book.create'),
            'can_mass_destroy' => $member->can('book.mass_destroy'),
            'can_mass_approve' => $member->can('book.mass_approve'),
        ]);
    }
}
