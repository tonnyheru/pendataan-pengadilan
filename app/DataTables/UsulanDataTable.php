<?php

namespace App\DataTables;

use App\Helpers\PermissionCommon;
use App\Models\Pemohon;
use App\Models\Usulan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsulanDataTable extends DataTable
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
                if (PermissionCommon::check('usulan.update')) {
                    $html .= '<button onclick="edit(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-pen"></i></button>';
                }
                if (PermissionCommon::check('usulan.delete')) {
                    $html .= '<button onclick="destroy(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>';
                }
                $html .= '</div><br>';

                if (PermissionCommon::check('usulan.approve_panitra')) {
                    if ($item->is_approve == 1) {
                        $html .= '<button onclick="approve(\'' . $item->uid . '\',\'panitra\')" type="button" class="btn btn-sm bg-primary text-white mt-1" title="Approve Usulan"><i class="fas fa-clipboard-check"></i> Approve </button>';
                        $html .= '<button onclick="reject(\'' . $item->uid . '\',\'panitra\')" type="button" class="btn btn-sm bg-danger text-white mt-1" title="Tolak Usulan"><i class="fas fa-times-hexagon"></i> Tolak </button><br>';
                    }
                }

                if (PermissionCommon::check('usulan.approve_disdukcapil')) {
                    if ($item->is_approve == 2) {
                        $html .= '<button onclick="approve(\'' . $item->uid . '\',\'disdukcapil\')" type="button" class="btn btn-sm bg-primary text-white mt-1" title="Approve Usulan"><i class="fas fa-clipboard-check"></i> Approve </button>';
                        $html .= '<button onclick="reject(\'' . $item->uid . '\',\'disdukcapil\')" type="button" class="btn btn-sm bg-danger text-white mt-1" title="Tolak Usulan"><i class="fas fa-times-hexagon"></i> Tolak </button><br>';
                    }
                }
                $html .= '<button onclick="show_catatan(\'' . $item->uid . '\')" type="button" class="btn btn-sm bg-diy text-white mt-1" title="Lihat Catatan"><i class="fas fa-eye"></i> Lihat Catatan </button>';
                return $html;
            })
            ->addColumn('dokumen', function ($item) {
                $html = '';
                $html .= '<button onclick="show_doc(\'' . $item->path_ktp . '\',\'file_ktp\')" type="button" class="btn btn-sm bg-diy text-white mb-1" title="Lihat KTP"><i class="fas fa-file-pdf"></i> Lihat KTP </button>';
                $html .= '<button onclick="show_doc(\'' . $item->path_kk . '\',\'file_kk\')" type="button" class="btn btn-sm bg-diy text-white mb-1" title="Lihat KK"><i class="fas fa-file-pdf"></i> Lihat KK </button><br>';
                $html .= '<button onclick="show_doc(\'' . $item->path_akta . '\',\'file_akta\')" type="button" class="btn btn-sm bg-diy text-white mb-1" title="Lihat Akta"><i class="fas fa-file-pdf"></i> Lihat Akta </button>';
                if ($item->path_pendukung) {
                    $html .= '<button onclick="show_doc(\'' . $item->path_pendukung . '\',\'file_pendukung\')" type="button" class="btn btn-sm bg-diy text-white mb-1" title="Lihat Dokumen Pendukung"><i class="fas fa-file-pdf"></i> Pendukung </button>';
                }
                // $html = '<div class="btn-group btn-group-sm">';
                // $html .= '</div>';
                return $html;
            })
            ->addColumn('pemohon', function ($data) {
                $pemohon = "";
                if (isset($data->pemohon)) {
                    $pemohon = $data->pemohon->name;
                }
                return $pemohon;
            })
            ->filterColumn('pemohon', function ($query, $keyword) {
                // Assuming you have a relationship between the user and role (e.g., user->role->name)
                $query->whereHas('pemohon', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('pemohon', function ($query, $direction) {
                $query->orderBy(
                    Pemohon::select('name')
                        ->whereColumn('pemohon.uid', 'usulan.pemohon_uid')
                        ->limit(1),
                    $direction
                );
            })

            ->addColumn('status', function ($data) {
                switch ($data->is_approve) {
                    case '0':
                        return '<span class="badge bg-danger text-white">Ditolak</span>';
                        break;
                    case '1':
                        return '<span class="badge bg-warning text-white">Perlu Disetujui Panitra</span>';
                        break;
                    case '2':
                        return '<span class="badge bg-info text-white">Perlu Disetujui Disdukcapil</span>';
                        break;
                    case '3':
                        return '<span class="badge bg-success text-white">Disetujui</span>';
                        break;

                    default:
                        return '';
                        break;
                }
            })
            ->rawColumns(['action', 'dokumen', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Usulan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Usulan $model): QueryBuilder
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
        // $button[] = Button::make('excel')->text('<span title="Export Excel"><i class="fa fa-file-excel"></i></span>');
        if (PermissionCommon::check('usulan.create')) {
            $button[] = Button::raw('<i class="fa fa-plus"></i> Tambahkan Usulan')->action('function() { create() }');
        }
        return $this->builder()
            ->parameters([
                'language' => [
                    'search' => '<i class="fas fa-search"></i>',
                    'infoFiltered' => ''
                ],
            ])
            ->setTableId('usulan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-6'B><'col-sm-3'f><'col-sm-3'l>> <'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(3)
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
        if (PermissionCommon::check('usulan.update') || PermissionCommon::check('usulan.delete') || PermissionCommon::check('usulan.approve_panitra') || PermissionCommon::check('usulan.approve_disdukcapil')) {
            $column[] = Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center');
        }
        $column[] = Column::computed('dokumen')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->title("Dokumen - Dokumen")
            ->addClass('text-center');
        $column[] = Column::make('status')
            ->width(100)
            ->title('Status Approval');
        $column[] = Column::make('no_perkara');
        $column[] = Column::make('jenis_perkara');
        $column[] = Column::make('pemohon');
        return $column;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Usulan_' . date('YmdHis');
    }
}
