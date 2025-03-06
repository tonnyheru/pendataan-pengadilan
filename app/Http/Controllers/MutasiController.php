<?php

namespace App\Http\Controllers;

use App\DataTables\MutasiDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\PermissionCommon;
use App\Models\Mutasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MutasiDataTable $dataTable)
    {
        if (!PermissionCommon::check('mutasi.list')) abort(403);
        return $dataTable->render('pages.administrasi.mutasi.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('mutasi.create')) abort(403);
        $body = view('pages.administrasi.mutasi.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Upload Mutasi',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $formData = $request->except(["_token", "_method"]);
            if ($request->hasFile('file_mutasi')) {
                $file = $request->file('file_mutasi');

                // Validate the new file
                $request->validate([
                    'file_mutasi' => 'required|mimes:pdf,jpg,jpeg,png,gif|max:2048',
                ]);

                // Determine the new file name
                $filename = time() . '.' . $file->getClientOriginalExtension();

                // Update the form data with the new file name
                $user = AuthCommon::getUser();
                $formData['uid'] = Str::uuid()->toString();
                $formData['name'] = $filename;
                $formData['origin_name'] = $file->getClientOriginalName();
                $formData['created_by'] = $user->uid;
                $path = $file->move(public_path('upload'), $formData['name']);

                $trx = Mutasi::create($formData);
                if ($trx) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil Upload File Mutasi'
                    ], 200);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Upload File Mutasi'
                ], 400);
            }
        } catch (\Throwable $th) {
            throw $th;
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
     * Display the specified resource.
     */
    public function show(Mutasi $mutasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mutasi $mutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mutasi $mutasi)
    {
        try {
            if ($mutasi->name && file_exists(public_path('upload/' . $mutasi->name))) {
                unlink(public_path('upload/' . $mutasi->name));
            }
            $delete = $mutasi->delete();
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
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }
}
