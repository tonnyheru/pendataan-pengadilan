<?php

namespace App\Http\Controllers;

use App\DataTables\PerbaikanAktaDetailDataTable;
use App\Models\PerbaikanAktaDetail;
use Illuminate\Http\Request;

class PerbaikanAktaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PerbaikanAktaDetailDataTable $dataTable)
    {
        // if (!PermissionCommon::check('role.list')) abort(403);
        return $dataTable->render('pages.administrasi.usulan.perbaikan_akta.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(PerbaikanAktaDetail $perbaikanAktaDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerbaikanAktaDetail $perbaikanAktaDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerbaikanAktaDetail $perbaikanAktaDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerbaikanAktaDetail $perbaikanAktaDetail)
    {
        //
    }
}
