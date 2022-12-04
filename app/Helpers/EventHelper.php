<?php

namespace App\Helpers;


trait EventHelper
{
    public function event_datatable($data, $bizType)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $bizType,
            'can_edit' => $bizType->can('event.edit'),
            'can_show' => $bizType->can('event.view'),
            'can_delete' => $bizType->can('event.delete'),
            'can_approve' => $bizType->can('event.edit'),
        ]);
    }
}
