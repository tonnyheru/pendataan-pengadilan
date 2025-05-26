<?php

namespace App\Http\Controllers;

use App\DataTables\AktaPerkawinanDetailDataTable;
use App\Helpers\PermissionCommon;
use App\Models\AktaPerkawinanDetail;
use App\Models\Disdukcapil;
use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AktaPerkawinanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AktaPerkawinanDetailDataTable $dataTable)
    {
        if (!PermissionCommon::check('akta_perkawinan.list')) abort(403);
        return $dataTable->render('pages.administrasi.usulan.akta_perkawinan.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('akta_perkawinan.create')) abort(403);
        $pemohon = Pemohon::all();
        $disdukcapil = Disdukcapil::all();
        $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
        $body = view('pages.administrasi.usulan.akta_perkawinan.create', compact('pemohon', 'disdukcapil', 'provinces'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Tambah Usulan Penerbitan Akta Perkawinan',
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
    public function show(AktaPerkawinanDetail $aktaPerkawinanDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AktaPerkawinanDetail $aktaPerkawinanDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AktaPerkawinanDetail $aktaPerkawinanDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AktaPerkawinanDetail $aktaPerkawinanDetail)
    {
        //
    }
}
