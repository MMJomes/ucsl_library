<?php

namespace App\Helpers;
trait MemberHelper
{
    public function member_datatable($data, $member)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $member,
            'can_edit' => $member->can('member.edit'),
            'can_show' => $member->can('member.view'),
            'can_delete' => $member->can('member.delete'),
            'can_approve' => $member->can('member.approve'),
            'can_multi_create' => $member->can('member.create'),
            'can_mass_destroy' => $member->can('member.mass_destroy'),
            'can_mass_approve' => $member->can('member.mass_approve'),
        ]);
    }
}
