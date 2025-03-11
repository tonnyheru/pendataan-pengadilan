<?php

namespace App\Http\Controllers;

use App\DataTables\UsulanDataTable;
use App\Helpers\PermissionCommon;
use App\Models\Pemohon;
use App\Models\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsulanDataTable $dataTable)
    {
        if (!PermissionCommon::check('usulan.list')) abort(403);
        return $dataTable->render('pages.administrasi.usulan.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('usulan.create')) abort(403);
        $pemohon = Pemohon::all();
        $body = view('pages.administrasi.usulan.create', compact('pemohon'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
        return [
            'title' => 'Tambahkan Usulan',
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
    public function show(Usulan $usulan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usulan $usulan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usulan $usulan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usulan $usulan)
    {
        //
    }
}
