<?php

namespace App\Helpers;


trait EventCategoryHelper
{
    public function eventcategory_datatable($data, $eventcategory)
    {
        return json_encode([
            'data' => $data,
            'recordsTotal' => $data->count(),
            'recordsFiltered' => $data->count(),
            'draw' => 1,
            'user' => $eventcategory,
            'can_edit' => $eventcategory->can('eventcategory.edit'),
            'can_show' => $eventcategory->can('eventcategory.view'),
            'can_delete' => $eventcategory->can('eventcategory.delete'),
            'can_approve' => $eventcategory->can('eventcategory.edit'),
        ]);
    }
}
