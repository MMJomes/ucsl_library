<?php

namespace App\Helpers;


trait AuthorHelper
{
    public function Author_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('author.create'),
            'can_show' => $bizType->can('author.view'),
            'can_delete' => $bizType->can('author.delete'),
            'can_approve' => $bizType->can('author.edit'),
        ]);
    }
}
