<?php

namespace App\DataTables;

use App\Helpers\PermissionCommon;
use App\Models\Disdukcapil;
use App\Models\PembatalanPerceraianDetail;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PembatalanPerceraianDetailDataTable extends DataTable
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
                if (PermissionCommon::check('pembatalan_perceraian.update')) {
                    $html .= '<button onclick="edit(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-pen"></i></button>';
                }
                if (PermissionCommon::check('pembatalan_perceraian.delete')) {
                    if ($item->submission->status != 0 && $item->submission->status != 2) {
                        $html .= '<button onclick="destroy(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>';
                    }
                }
                $html .= '</div>';
                $html .= '<br><button onclick="show_catatan(\'' . $item->uid . '\')" type="button" class="btn btn-sm bg-diy text-white mt-1" title="Lihat Catatan"><i class="fas fa-eye"></i> Lihat Catatan </button>';
                if (PermissionCommon::check('usulan.approve_disdukcapil')) {
                    if ($item->submission->status == 1) {
                        $html .= '<br><button onclick="approve(\'' . $item->submission->uid . '\',\'pembatalan_perceraian\')" type="button" class="btn btn-sm bg-primary text-white mt-1" title="Approve Usulan"><i class="fas fa-clipboard-check"></i> Approve </button>';
                        $html .= '<button onclick="reject(\'' . $item->submission->uid . '\',\'pembatalan_perceraian\')" type="button" class="btn btn-sm bg-danger text-white mt-1" title="Tolak Usulan"><i class="fas fa-times-hexagon"></i> Tolak </button>';
                    }
                    // if ($item->submission->status == 2) {
                    //     $html .= '<br><button onclick="sendMail(\'' . $item->submission->uid . '\')" type="button" class="btn btn-sm bg-diy text-white mt-1" title="Kirim Email"><i class="fas fa-paper-plane"></i> Kirim Email </button>';
                    // }
                }
                return $html;
            })
            ->addColumn('dokumen', function ($item) {
                $html = '';
                $documents = $item->submission->documents;
                if ($documents->count() > 0) {
                    foreach ($documents as $i => $document) {
                        $html .= '<button onclick="show_doc(\'' . $document->file_path . '\',\'file_' . $document->document_type . '\')" type="button" class="btn btn-sm bg-diy text-white mb-1" title="Lihat ' . ucwords(str_replace('_', ' ', $document->document_type)) . '"><i class="fas fa-file-pdf"></i> Lihat ' . ucwords(str_replace('_', ' ', $document->document_type)) . ' </button>';
                        if ($i % 2 == 1) {
                            $html .= '<br>';
                        }
                    }
                }
                // $html = '<div class="btn-group btn-group-sm">';
                // $html .= '</div>';
                return $html;
            })

            ->addColumn('no_perkara', function ($data) {
                $no_perkara = "";
                if (isset($data->submission)) {
                    $no_perkara = $data->submission->no_perkara;
                }
                return $no_perkara;
            })
            ->filterColumn('no_perkara', function ($query, $keyword) {
                $query->whereHas('submission', function ($q) use ($keyword) {
                    $q->where('no_perkara', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('no_perkara', function ($query, $direction) {
                $query->orderBy(
                    Submission::select('no_perkara')
                        ->whereColumn('submissions.uid', 'pembatalan_perceraian_details.submission_uid')
                        ->limit(1),
                    $direction
                );
            })

            ->addColumn('pemohon', function ($data) {
                $pemohon = "";
                if (isset($data->submission)) {
                    $pemohon = $data->submission->pemohon->name;
                }
                return $pemohon;
            })
            ->filterColumn('pemohon', function ($query, $keyword) {
                $query->whereHas('submission.pemohon', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('pemohon', function ($query, $direction) {
                $query->orderBy(
                    Submission::select('pemohons.name')
                        ->whereColumn('submissions.uid', 'pembatalan_perceraian_details.submission_uid')
                        ->limit(1),
                    $direction
                );
            })

            ->addColumn('disdukcapil', function ($data) {
                $disdukcapil = "?";
                if (isset($data->submission)) {
                    $disdukcapil = $data->submission->disdukcapil->nama;
                }
                return $disdukcapil;
            })
            ->filterColumn('disdukcapil', function ($query, $keyword) {
                $query->whereHas('submission.disdukcapil', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('disdukcapil', function ($query, $direction) {
                $query->orderBy(
                    Submission::select('disdukcapil.nama')
                        ->whereColumn('submissions.uid', 'pembatalan_perceraian_details.submission_uid')
                        ->limit(1),
                    $direction
                );
            })

            ->addColumn('status', function ($data) {
                $status = "?";
                if (isset($data->submission)) {
                    $status = $data->submission->status;
                    switch ($status) {
                        case '0':
                            $status = '<span class="badge bg-danger text-white">Ditolak</span>';
                            break;
                        case '1':
                            $status = '<span class="badge bg-warning text-white">Perlu Persetujuan :<br> ' . $data->submission->disdukcapil->nama . '</span>';
                            break;
                        case '2':
                            $status = '<span class="badge bg-success text-white">Diterima</span>';
                            break;
                        default:
                            $status = '<span class="badge bg-danger text-white">Ditolak</span>';
                            break;
                    }
                }
                return $status;
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->whereHas('submission', function ($q) use ($keyword) {
                    $q->where('status', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('status', function ($query, $direction) {
                $query->orderBy(
                    Submission::select('status')
                        ->whereColumn('submissions.uid', 'pembatalan_perceraian_details.submission_uid')
                        ->limit(1),
                    $direction
                );
            })



            ->rawColumns(['action', 'status', 'dokumen']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PembatalanPerceraianDetail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PembatalanPerceraianDetail $model): QueryBuilder
    {
        if (str_contains(auth()->user()->role->slug, 'disdukcapil')) {
            $role = auth()->user()->role->slug;
            $uid = Disdukcapil::whereRaw("LOWER(REPLACE(nama, ' ', '_')) = ?", [$role])
                ->value('uid');

            return $model->newQuery()
                ->join('submissions', 'submissions.uid', '=', 'pembatalan_perceraian_details.submission_uid')
                ->where('submissions.disdukcapil_uid', $uid);
        }
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
        $button[] = Button::make('excel')->text('<span title="Export Excel"><i class="fa fa-file-excel"></i></span>');
        if (PermissionCommon::check('pembatalan_perceraian.create')) {
            $button[] = Button::raw('<i class="fa fa-plus"></i> Tambah Usulan Pembatalan Perceraian')->action('function() { create() }');
        }
        return $this->builder()
            ->parameters([
                'language' => [
                    'search' => '<i class="fas fa-search"></i>',
                    'infoFiltered' => ''
                ],
            ])
            ->setTableId('pembatalanperceraiandetail-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-6'B><'col-sm-3'f><'col-sm-3'l>> <'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(2)
            ->scrollY(550)
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
        if (PermissionCommon::check('pembatalan_perceraian.update') || PermissionCommon::check('pembatalan_perceraian.delete') || PermissionCommon::check('usulan.approve_disdukcapil')) {
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
        $column[] = Column::make('no_perkara');
        $column[] = Column::make('status');
        $column[] = Column::make('nama_suami');
        $column[] = Column::make('nama_istri');
        return $column;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'PembatalanPerceraianDetail_' . date('YmdHis');
    }
}
