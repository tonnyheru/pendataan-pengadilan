<?php

namespace App\Http\Controllers;

use App\DataTables\PemohonDataTable;
use App\Helpers\PermissionCommon;
use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
        $body = view('pages.administrasi.pemohon.create', compact('provinces'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-info" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-info" onclick="nextStep()">Lanjut</button>';

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
        // dd($request->all());
        if (!PermissionCommon::check('pemohon.create')) abort(403);
        $request->validate([
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'name' => 'required',
            'kk' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
        ], [
            'province.required' => 'Provinsi tidak boleh kosong',
            'regency.required' => 'Kabupaten tidak boleh kosong',
            'district.required' => 'Kecamatan tidak boleh kosong',
            'village.required' => 'Desa tidak boleh kosong',
            'name.required' => 'Nama Lengkap tidak boleh kosong',
            'kk.required' => 'No KK tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'no_telp.required' => 'No Telpon tidak boleh kosong',
        ]);
        $data = $request->except('_token');
        try {
            $trx = Pemohon::create([
                'uid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'province' => $data['province'],
                'regency' => $data['regency'],
                'district' => $data['district'],
                'village' => $data['village'],
                'kk' => $data['kk'],
                'nik' => $data['nik'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'tempat_lahir' => $data['tempat_lahir'],
                'akta_kelahiran' => $data['akta_kelahiran'],
                'alamat' => $data['alamat'],
                'email' => $data['email'],
                'no_telp' => $data['no_telp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'blood_type' => $data['blood_type'],
                'agama' => $data['religion'],
                'status_kawin' => $data['status_kawin'],
                'akta_kawin' => $data['akta_kawin'],
                'tanggal_kawin' => $data['tanggal_kawin'],
                'akta_cerai' => $data['akta_cerai'],
                'tanggal_cerai' => $data['tanggal_cerai'],
                'family_relationship' => $data['family_relationship'],
                'education' => $data['education'],
                'job' => $data['job'],
                'nama_ibu' => $data['nama_ibu'],
                'nama_ayah' => $data['nama_ayah'],
                'nomor_paspor' => $data['nomor_paspor'],
                'tanggal_berlaku_paspor' => $data['tanggal_berlaku_paspor'],
                'keterangan' => $data['keterangan'],
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
            // dd($th);
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
    public function show(Pemohon $pemohon)
    {
        $body = view('pages.administrasi.pemohon.detail', compact('pemohon'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pemohon',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemohon $pemohon)
    {
        if (!PermissionCommon::check('pemohon.update')) abort(403);
        if ($pemohon) {
            $uid = $pemohon->uid;
            $data = $pemohon;
            $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
            // dd($data);
            $body = view('pages.administrasi.pemohon.edit', compact('uid', 'data', 'provinces'))->render();
            $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-info" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-info" onclick="nextStep()">Lanjut</button>';
            return [
                'title' => 'Edit Data Pemohon',
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
    public function update(Request $request, Pemohon $pemohon)
    {
        if (!PermissionCommon::check('pemohon.update')) abort(403);
        $request->validate([
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'name' => 'required',
            'kk' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
        ], [
            'province.required' => 'Provinsi tidak boleh kosong',
            'regency.required' => 'Kabupaten tidak boleh kosong',
            'district.required' => 'Kecamatan tidak boleh kosong',
            'village.required' => 'Desa tidak boleh kosong',
            'name.required' => 'Nama Lengkap tidak boleh kosong',
            'kk.required' => 'No KK tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'no_telp.required' => 'No Telpon tidak boleh kosong',
        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $trx = $pemohon->update($formData);
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
    public function destroy(Pemohon $pemohon)
    {
        if (!PermissionCommon::check('pemohon.delete')) abort(403);
        try {
            $delete = $pemohon->delete();
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
