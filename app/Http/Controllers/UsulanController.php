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
        if (!PermissionCommon::check('usulan.update')) abort(403);
        $request->validate([
            'no_perkara' => 'required|unique:usulan,no_perkara',
            'jenis_perkara' => 'required',
            'pemohon_uid' => 'required',
            'file_ktp' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pendukung' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'jenis_perkara.required' => 'Jenis Perkara tidak boleh kosong',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'file_ktp.required' => 'File KTP tidak boleh kosong',
            'file_ktp.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp.max' => 'Ukuran file ktp maksimal 2MB',
            'file_kk.required' => 'File KK tidak boleh kosong',
            'file_kk.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk.max' => 'Ukuran file kk maksimal 2MB',
            'file_akta.required' => 'File Akta tidak boleh kosong',
            'file_akta.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta.max' => 'Ukuran file akta maksimal 2MB',
            'file_pendukung.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pendukung.max' => 'Ukuran file pendukung maksimal 2MB',
        ]);
        $data = $request->except('_token');
        try {

            if ($request->hasFile('file_ktp')) {
                $file_ktp = $request->file('file_ktp');
                $file_ktp_name = md5('ktp' . time()) . time() . '_' . $file_ktp->getClientOriginalName();
                $data['path_ktp'] = $file_ktp_name;
            }

            if ($request->hasFile('file_kk')) {
                $file_kk = $request->file('file_kk');
                $file_kk_name = md5('kk' . time()) . time() . '_' . $file_kk->getClientOriginalName();
                $data['path_kk'] = $file_kk_name;
            }

            if ($request->hasFile('file_akta')) {
                $file_akta = $request->file('file_akta');
                $file_akta_name = md5('ktp' . time()) . time() . '_' . $file_akta->getClientOriginalName();
                $data['path_akta'] = $file_akta_name;
            }

            if ($request->hasFile('file_pendukung')) {
                $file_pendukung = $request->file('file_pendukung');
                $file_pendukung_name = md5('ktp' . time()) . time() . '_' . $file_pendukung->getClientOriginalName();
                $data['path_pendukung'] = $file_pendukung_name;
            }

            // status 0 = ditolak / revisi
            // status 1 = belum di approve
            // status 2 = sudah di approve admin
            // status 3 = sudah di approve disdukcapil

            $trx = Usulan::create([
                'uid' => Str::uuid()->toString(),
                'no_perkara' => $data['no_perkara'],
                'jenis_perkara' => $data['jenis_perkara'],
                'path_ktp' => $data['path_ktp'],
                'path_kk' => $data['path_kk'],
                'path_akta' => $data['path_akta'],
                'path_pendukung' => $data['path_pendukung'] ?? null,
                'pemohon_uid' => $data['pemohon_uid'],
                'is_approve' => '1',
                'created_by' => auth()->user()->uid,
            ]);

            if ($trx) {
                if ($request->hasFile('file_ktp')) {
                    $file_ktp = $request->file('file_ktp');
                    $file_ktp->move(public_path('upload/file_ktp'), $data['path_ktp']);
                }

                if ($request->hasFile('file_kk')) {
                    $file_kk = $request->file('file_kk');
                    $file_kk->move(public_path('upload/file_kk'), $data['path_kk']);
                }

                if ($request->hasFile('file_akta')) {
                    $file_akta = $request->file('file_akta');
                    $file_akta->move(public_path('upload/file_akta'), $data['path_akta']);
                }

                if ($request->hasFile('file_pendukung')) {
                    $file_pendukung = $request->file('file_pendukung');
                    $file_pendukung->move(public_path('upload/file_pendukung'), $data['path_pendukung']);
                }

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
    public function show(Usulan $usulan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usulan $usulan)
    {
        if (!PermissionCommon::check('usulan.update')) abort(403);
        if ($usulan) {
            $uid = $usulan->uid;
            $data = $usulan;
            $pemohon = Pemohon::all();
            $body = view('pages.administrasi.usulan.edit', compact('uid', 'data', 'pemohon'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Data Usulan',
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
    public function update(Request $request, Usulan $usulan)
    {
        if (!PermissionCommon::check('usulan.update')) abort(403);
        $request->validate([
            'no_perkara' => "required|unique:usulan,no_perkara,$usulan->uid,uid",
            'jenis_perkara' => 'required',
            'pemohon_uid' => 'required',
            'file_ktp' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pendukung' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'jenis_perkara.required' => 'Jenis Perkara tidak boleh kosong',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'file_ktp.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp.max' => 'Ukuran file ktp maksimal 2MB',
            'file_kk.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk.max' => 'Ukuran file kk maksimal 2MB',
            'file_akta.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta.max' => 'Ukuran file akta maksimal 2MB',
            'file_pendukung.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pendukung.max' => 'Ukuran file pendukung maksimal 2MB',
        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            if ($request->hasFile('file_ktp')) {
                $file = $request->file('file_ktp');

                // Determine the new file name
                $filename = md5('ktp' . time()) . time() . '_' . $file->getClientOriginalName();

                // Delete the old profile image if it exists
                if ($usulan->path_ktp && file_exists(public_path('upload/file_ktp/' . $usulan->path_ktp))) {
                    unlink(public_path('upload/file_ktp/' . $usulan->path_ktp));
                }

                // Save the new file
                $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['path_ktp'] = $filename;
            }
            if ($request->hasFile('file_kk')) {
                $file = $request->file('file_kk');

                // Determine the new file name
                $filename = md5('kk' . time()) . time() . '_' . $file->getClientOriginalName();

                // Delete the old profile image if it exists
                if ($usulan->path_kk && file_exists(public_path('upload/file_kk/' . $usulan->path_kk))) {
                    unlink(public_path('upload/file_kk/' . $usulan->path_kk));
                }

                // Save the new file
                $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['path_kk'] = $filename;
            }
            if ($request->hasFile('file_akta')) {
                $file = $request->file('file_akta');

                // Determine the new file name
                $filename = md5('akta' . time()) . time() . '_' . $file->getClientOriginalName();

                // Delete the old profile image if it exists
                if ($usulan->path_akta && file_exists(public_path('upload/file_akta/' . $usulan->path_akta))) {
                    unlink(public_path('upload/file_akta/' . $usulan->path_akta));
                }

                // Save the new file
                $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['path_akta'] = $filename;
            }
            if ($request->hasFile('file_pendukung')) {
                $file = $request->file('file_pendukung');

                // Determine the new file name
                $filename = md5('pendukung' . time()) . time() . '_' . $file->getClientOriginalName();

                // Delete the old profile image if it exists
                if ($usulan->path_pendukung && file_exists(public_path('upload/file_pendukung/' . $usulan->path_pendukung))) {
                    unlink(public_path('upload/file_pendukung/' . $usulan->path_pendukung));
                }

                // Save the new file
                $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['path_pendukung'] = $filename;
            }

            $trx = $usulan->update($formData);
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
    public function destroy(Usulan $usulan)
    {
        if (!PermissionCommon::check('usulan.delete')) abort(403);
        try {
            if ($usulan->path_ktp && file_exists(public_path('upload/file_ktp/' . $usulan->path_ktp))) {
                unlink(public_path('upload/file_ktp/' . $usulan->path_ktp));
            }
            if ($usulan->path_kk && file_exists(public_path('upload/file_kk/' . $usulan->path_kk))) {
                unlink(public_path('upload/file_kk/' . $usulan->path_kk));
            }
            if ($usulan->path_akta && file_exists(public_path('upload/file_akta/' . $usulan->path_akta))) {
                unlink(public_path('upload/file_akta/' . $usulan->path_akta));
            }
            if ($usulan->path_pendukung && file_exists(public_path('upload/file_pendukung/' . $usulan->path_pendukung))) {
                unlink(public_path('upload/file_pendukung/' . $usulan->path_pendukung));
            }
            $delete = $usulan->delete();
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

    public function approvement()
    {
        if (!PermissionCommon::check('usulan.approve_panitra')) abort(403);
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);

        $body = view('pages.administrasi.usulan.form_approve')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
        return [
            'title' => 'Approve Usulan',
            'body' => $body,
            'footer' => $footer
        ];
    }

    public function approvement_store(Request $request)
    {
        try {
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

    public function rejectment()
    {
        if (!PermissionCommon::check('usulan.approve_panitra')) abort(403);
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);

        $body = view('pages.administrasi.usulan.form_reject')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
        return [
            'title' => 'Approve Usulan',
            'body' => $body,
            'footer' => $footer
        ];
    }

    public function rejectment_store()
    {
        try {
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
}
