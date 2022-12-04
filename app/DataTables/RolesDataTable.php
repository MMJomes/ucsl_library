<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $user = auth()->user();
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('permissions',function($query){
                $html = '<div class="row mx-2">';

                foreach($query->permissions as $value)
                {
                    $html .= '<span class="badge badge-info m-1">'.$value->name.'</span>';
                }

                $html .= '</div>';

                return $html;
            })
            ->addColumn('action', function ($query) use ($user) {
                $edit_route = route('backend.roles.edit', $query->id);
                $actionBtn = '<div class="d-flex align-self-center">';
                if ($user->can('role.edit')) {
                    $actionBtn .= '<a class="btn btn-outline-info btn-sm mr-3" href="' . $edit_route . '"> <span class="sr-only">Copy</span> <i class="fa fa-edit"></i>
                            </a>';
                }
                if ($query->id != 1) {
                    if ($user->can('role.delete')) {
                        $actionBtn .= '<a class="btn btn-outline-danger btn-sm delete-btn" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" data-id="' . $query->id . '">
                        <span class="sr-only">Delete</span> <i class="fa fa-trash"></i>
                                </a>';
                    }
                }

                $actionBtn .= '</div>';
                return $actionBtn;
            })
            ->rawColumns(['action','permissions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->parameters([
                        'responsive' => true,
                        'defaultContent' => '',
                    ])
                    ->setTableId('roles-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->action("window.location = '".route('backend.roles.create')."';"),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                        // [
                        //     'deleteSelected',
                        // ],
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'DT_RowIndex','title'=>'No','data'=>"DT_RowIndex"],
            'name',
            'permissions',
            'action'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Roles_' . date('YmdHis');
    }
}
