<?php

namespace App\Http\Controllers;

use App\DataTables\DisdukcapilDataTable;
use App\Helpers\PermissionCommon;
use App\Models\Disdukcapil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DisdukcapilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DisdukcapilDataTable $dataTable)
    {
        if (!PermissionCommon::check('disdukcapil.list')) abort(403);
        return $dataTable->render('pages.master.disdukcapil.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('disdukcapil.create')) abort(403);
        $body = view('pages.master.disdukcapil.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Tambah Disdukcapil',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!PermissionCommon::check('disdukcapil.create')) abort(403);
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'cdn_picture' => 'required',
        ], [
            'nama.required' => 'Nama Disdukcapil tidak boleh kosong',
            'alamat.required' => 'Alamat Disdukcapil tidak boleh kosong',
            'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
            'email.required' => 'Email Disdukcapil tidak boleh kosong',
            'cdn_picture.required' => 'Tautan Gambar tidak boleh kosong',
        ]);
        $data = $request->except('_token');
        try {
            $trx = Disdukcapil::create([
                'uid' => Str::uuid()->toString(),
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'no_telp' => $data['no_telp'],
                'email' => $data['email'],
                'cdn_picture' => $data['cdn_picture'],
                'created_by' => auth()->user()->uid,
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Mendaftarkan Pemohon'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Mendaftarkan Pemohon'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal'
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Disdukcapil $disdukcapil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disdukcapil $disdukcapil)
    {
        if (!PermissionCommon::check('disdukcapil.update')) abort(403);
        if ($disdukcapil) {
            $uid = $disdukcapil->uid;
            $data = $disdukcapil;
            $body = view('pages.master.disdukcapil.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Data Disdukcapil',
                'body' => $body,
                'footer' => $footer
            ];
        } else {
            return response([
                'status' => false,
                'message' => 'Failed Connect to Server'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disdukcapil $disdukcapil)
    {
        if (!PermissionCommon::check('disdukcapil.update')) abort(403);
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'cdn_picture' => 'required',
        ], [
            'nama.required' => 'Nama Disdukcapil tidak boleh kosong',
            'alamat.required' => 'Alamat Disdukcapil tidak boleh kosong',
            'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
            'email.required' => 'Email Disdukcapil tidak boleh kosong',
            'cdn_picture.required' => 'Tautan Gambar tidak boleh kosong',
        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $trx = $disdukcapil->update($formData);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Data Berhasil Diubah'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Data Gagal Diubah'
                ], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disdukcapil $disdukcapil)
    {
        if (!PermissionCommon::check('disdukcapil.delete')) abort(403);
        try {
            $delete = $disdukcapil->delete();
            if ($delete) {
                return response()->json([
                    'message' => 'Berhasil Menghapus Data'
                ]);
            } else {
                return response()->json([
                    'message' => 'Gagal Menghapus Data'
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Data Failed, this data is still used in other modules !'
            ]);
        }
    }
}
