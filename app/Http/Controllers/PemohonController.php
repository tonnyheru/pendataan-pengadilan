<?php

namespace App\Http\Controllers;

use App\DataTables\PemohonDataTable;
use App\Helpers\PermissionCommon;
use App\Models\Pemohon;
use Illuminate\Http\Request;

class PemohonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemohonDataTable $dataTable)
    {
        if (!PermissionCommon::check('pemohon.list')) abort(403);
        return $dataTable->render('pages.administrasi.pemohon.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('pemohon.create')) abort(403);
        $body = view('pages.administrasi.pemohon.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Daftarkan Pemohon',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!PermissionCommon::check('pemohon.create')) abort(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemohon $pemohon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemohon $pemohon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemohon $pemohon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemohon $pemohon)
    {
        //
    }
}
