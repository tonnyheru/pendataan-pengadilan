<?php

namespace App\Http\Controllers;

use App\DataTables\AktaKematianDetailDataTable;
use App\Helpers\PermissionCommon;
use App\Models\AktaKematianDetail;
use App\Models\Disdukcapil;
use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AktaKematianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AktaKematianDetailDataTable $dataTable)
    {       
        if (!PermissionCommon::check('akta_kematian.list')) abort(403);
        return $dataTable->render('pages.administrasi.usulan.akta_kematian.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('akta_kematian.create')) abort(403);
        $pemohon = Pemohon::all();
        $disdukcapil = Disdukcapil::all();
        $body = view('pages.administrasi.usulan.akta_kematian.create', compact('pemohon', 'disdukcapil'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Tambah Usulan Penerbitan Akta Kematian',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AktaKematianDetail $aktaKematianDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AktaKematianDetail $aktaKematianDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AktaKematianDetail $aktaKematianDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AktaKematianDetail $aktaKematianDetail)
    {
        //
    }
}
