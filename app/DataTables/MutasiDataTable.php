<?php

namespace App\DataTables;

use App\Helpers\PermissionCommon;
use App\Models\Mutasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MutasiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($item) {
                $html = '';
                $html = '<div class="btn-group btn-group-sm">';
                // if (PermissionCommon::check('mutasi.update')) {
                //     $html .= '<button onclick="edit(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-pen"></i></button>';
                // }
                if (PermissionCommon::check('mutasi.delete')) {
                    $html .= '<button onclick="destroy(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>';
                }
                $html .= '</div>';
                return $html;
            })

            ->addColumn('name', function ($data) {
                return '<a href="' . asset('upload') . '/' . $data->name . '">' . $data->origin_name . '</a>';
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->orderColumn('name', function ($query, $direction) {
                $query->orderBy('name', $direction);
            })

            ->addColumn('created_by', function ($data) {
                $user = "";
                if (isset($data->user)) {
                    $user = $data->user->name;
                }
                return $user;
            })
            ->filterColumn('created_by', function ($query, $keyword) {
                // Assuming you have a relationship between the user and role (e.g., user->role->name)
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('created_by', function ($query, $direction) {
                $query->orderBy(
                    User::select('name')
                        ->whereColumn('user.uid', 'mutasi.created_by')
                        ->limit(1),
                    $direction
                );
            })
            ->rawColumns(['action', 'name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Mutasi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Mutasi $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $button = [];
        if (PermissionCommon::check('mutasi.create')) {
            $button[] = Button::raw('<i class="fa fa-plus"></i> Upload Mutasi')->action('function() { create() }');
        }
        return $this->builder()
            ->setTableId('mutasi-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-6'B><'col-sm-3'f><'col-sm-3'l>> <'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(1)
            ->scrollY(350)
            // ->selectStyleSingle()
            ->buttons($button);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        $column = [];
        if (PermissionCommon::check('mutasi.update') || PermissionCommon::check('mutasi.delete')) {
            $column[] = Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center');
        }
        $column[] = Column::make('name')->title('File Mutasi');
        $column[] = Column::make('created_by')->title('Diupload Oleh');
        return $column;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Mutasi_' . date('YmdHis');
    }
}
