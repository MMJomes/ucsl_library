<?php

namespace App\DataTables;

use App\Models\Admin;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminsDataTable extends DataTable
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
            ->addColumn('action', function ($query) use ($user) {
                $edit_route = route('backend.admins.edit', $query->slug);
                $actionBtn = '<div class="d-flex align-self-center">';
                if ($user->can('admin.edit')) {
                    $actionBtn .= '<a class="btn btn-outline-info btn-sm mr-3" href="' . $edit_route . '"> <span class="sr-only">Copy</span> <i class="fa fa-edit"></i>
                            </a>';
                }

                if ($user->can('admin.delete')) {
                    $actionBtn .= '<a class="btn btn-outline-danger btn-sm delete-btn" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" data-id="' . $query->id . '">
                    <span class="sr-only">Delete</span> <i class="fa fa-trash"></i>
                            </a>';
                }
                $actionBtn .= '</div>';
                return $actionBtn;
            })
            ->editColumn('image', function($query) {
                return '<img src="'.url($query->image).'" width="50px" height="50px">';
            })
            ->rawColumns(['action','image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
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
                    ->setTableId('admins-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->action("window.location = '".route('backend.admins.create')."';"),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
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
            'image',
            'name',
            'email',
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
        return 'Admins_' . date('YmdHis');
    }
}
