<?php

namespace App\Http\Controllers;

use App\DataTables\AktaKematianDetailDataTable;
use App\Helpers\PermissionCommon;
use App\Models\AktaKematianDetail;
use App\Models\Disdukcapil;
use App\Models\Pemohon;
use App\Models\Submission;
use App\Models\SubmissionDocument;
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
        $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
        $body = view('pages.administrasi.usulan.akta_kematian.create', compact('pemohon', 'disdukcapil', 'provinces'))->render();
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
        if (!PermissionCommon::check('perbaikan_akta.create')) abort(403);
        $request->validate([
            'no_perkara' => 'required|unique:submissions,no_perkara',
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nik_jenazah' => 'required',
            'nama_jenazah' => 'required',
            'wilayah_kelahiran' => 'required',
            'provinsi_kelahiran' => 'required',
            'tanggal_kematian' => 'required',
            'waktu_kematian' => 'required',
            'tempat_kematian' => 'required',
            'sebab_kematian' => 'required',
            'yang_menerangkan' => 'required',

            'nik_ayah' => 'required',
            'nama_ayah' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'nik_saksi1' => 'required',
            'nama_saksi1' => 'required',

            'file_penetapan_pengadilan' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_pemohon' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_pemohon' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_surat_kematian' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',
            'nik_jenazah.required' => 'NIK Jenazah tidak boleh kosong',
            'nama_jenazah.required' => 'Nama Jenazah tidak boleh kosong',
            'wilayah_kelahiran.required' => 'Wilayah Kelahiran tidak boleh kosong',
            'provinsi_kelahiran.required' => 'Provinsi Kelahiran tidak boleh kosong',
            'tanggal_kematian.required' => 'Tanggal Kematian tidak boleh kosong',
            'waktu_kematian.required' => 'Waktu Kematian tidak boleh kosong',
            'tempat_kematian.required' => 'Tempat Kematian tidak boleh kosong',
            'sebab_kematian.required' => 'Sebab Kematian tidak boleh kosong',
            'yang_menerangkan.required' => 'Yang Menerangkan tidak boleh kosong',
            'nik_ayah.required' => 'NIK Ayah tidak boleh kosong',
            'nama_ayah.required' => 'Nama Ayah tidak boleh kosong',
            'nik_ibu.required' => 'NIK Ibu tidak boleh kosong',
            'nama_ibu.required' => 'Nama Ibu tidak boleh kosong',
            'nik_saksi1.required' => 'NIK Saksi 1 tidak boleh kosong',
            'nama_saksi1.required' => 'Nama Saksi 1 tidak boleh kosong',

            'file_penetapan_pengadilan.required' => 'File Penetapan Pengadilan tidak boleh kosong',
            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_kk_pemohon.required' => 'File KK Pemohon tidak boleh kosong',
            'file_kk_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_pemohon.max' => 'Ukuran file KK Pemohon maksimal 2MB',

            'file_ktp_pemohon.required' => 'File KTP Pemohon tidak boleh kosong',
            'file_ktp_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_pemohon.max' => 'Ukuran file KTP Pemohon maksimal 2MB',

            'file_surat_kematian.required' => 'File Surat Kematian tidak boleh kosong',
            'file_surat_kematian.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_surat_kematian.max' => 'Ukuran file Surat Kematian maksimal 2MB',

        ]);

        $data = $request->except('_token');
        try {
            $submission = Submission::create([
                'uid' => Str::uuid()->toString(),
                'no_perkara' => $data['no_perkara'],
                'submission_type' => 'akta_kematian',
                'pemohon_uid' => $data['pemohon_uid'],
                'disdukcapil_uid' => $data['disdukcapil'],
                'status' => '1',
                'catatan' => json_encode([
                    [
                        'role' => auth()->user()->role->name,
                        'name' => auth()->user()->name,
                        'status' => '1',
                        'catatan' => $data['catatan'],
                        'timestamp' => date('Y-m-d H:i:s')
                    ]
                ]),
                'created_by' => auth()->user()->uid,
            ]);

            $documents = [];
            if ($request->hasFile('file_penetapan_pengadilan')) {
                $file_penetapan = $request->file('file_penetapan_pengadilan');
                $file_penetapan_name = md5('penetapan_pengadilan' . time()) . time() . '.' . $file_penetapan->getClientOriginalExtension();
                $data['path_penetapan'] = $file_penetapan_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_penetapan->getClientOriginalName(),
                    'document_type' => 'penetapan_pengadilan',
                    'file_path' => $file_penetapan_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_kk_pemohon')) {
                $file_kk_pemohon = $request->file('file_kk_pemohon');
                $file_kk_pemohon_name = md5('kk_pemohon' . time()) . time() . '.' . $file_kk_pemohon->getClientOriginalExtension();
                $data['path_kk_pemohon'] = $file_kk_pemohon_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_kk_pemohon->getClientOriginalName(),
                    'document_type' => 'kk_pemohon',
                    'file_path' => $file_kk_pemohon_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_ktp_pemohon')) {
                $file_ktp_pemohon = $request->file('file_ktp_pemohon');
                $file_ktp_pemohon_name = md5('ktp_pemohon' . time()) . time() . '.' . $file_ktp_pemohon->getClientOriginalExtension();
                $data['path_ktp_pemohon'] = $file_ktp_pemohon_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_ktp_pemohon->getClientOriginalName(),
                    'document_type' => 'ktp_pemohon',
                    'file_path' => $file_ktp_pemohon_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_surat_kematian')) {
                $file_surat_kematian = $request->file('file_surat_kematian');
                $file_surat_kematian_name = md5('surat_kematian' . time()) . time() . '.' . $file_surat_kematian->getClientOriginalExtension();
                $data['path_surat_kematian'] = $file_surat_kematian_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_surat_kematian->getClientOriginalName(),
                    'document_type' => 'surat_kematian',
                    'file_path' => $file_surat_kematian_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }


            // status 0 = ditolak / revisi
            // status 1 = belum di approve
            // status 2 = sudah di approve disdukcapil


            $submission_document = SubmissionDocument::insert($documents);
            $trx = AktaKematianDetail::create([
                'uid' => Str::uuid()->toString(),
                'submission_uid' => $submission->uid,
                'nik_jenazah' => $data['nik_jenazah'],
                'nama_jenazah' => $data['nama_jenazah'],
                'wilayah_kelahiran' => $data['wilayah_kelahiran'],
                'provinsi_kelahiran' => $data['provinsi_kelahiran'],
                'tanggal_kematian' => $data['tanggal_kematian'],
                'waktu_kematian' => $data['waktu_kematian'],
                'tempat_kematian' => $data['tempat_kematian'],
                'sebab_kematian' => $data['sebab_kematian'],
                'yang_menerangkan' => $data['yang_menerangkan'],
                'keterangan' => $data['keterangan'],
                'nik_ayah' => $data['nik_ayah'],
                'nama_ayah' => $data['nama_ayah'],
                'nik_ibu' => $data['nik_ibu'],
                'nama_ibu' => $data['nama_ibu'],
                'nik_saksi1' => $data['nik_saksi1'],
                'nama_saksi1' => $data['nama_saksi1'],
                'nik_saksi2' => $data['nik_saksi2'] ?? null,
                'nama_saksi2' => $data['nama_saksi2'] ?? null,
            ]);

            if ($trx) {
                if ($request->hasFile('file_penetapan_pengadilan')) {
                    $file_penetapan = $request->file('file_penetapan_pengadilan');
                    $file_penetapan->move(public_path('upload/file_penetapan_pengadilan'), $data['path_penetapan']);
                }

                if ($request->hasFile('file_kk_pemohon')) {
                    $file_kk_pemohon = $request->file('file_kk_pemohon');
                    $file_kk_pemohon->move(public_path('upload/file_kk_pemohon'), $data['path_kk_pemohon']);
                }

                if ($request->hasFile('file_ktp_pemohon')) {
                    $file_ktp_pemohon = $request->file('file_ktp_pemohon');
                    $file_ktp_pemohon->move(public_path('upload/file_ktp_pemohon'), $data['path_ktp_pemohon']);
                }

                if ($request->hasFile('file_surat_kematian')) {
                    $file_surat_kematian = $request->file('file_surat_kematian');
                    $file_surat_kematian->move(public_path('upload/file_surat_kematian'), $data['path_surat_kematian']);
                }

                // $disdukcapil = Disdukcapil::find($data['delegasi']);
                // $pemohon = Pemohon::find($data['pemohon_uid']);
                // if ($disdukcapil) {
                //     $notif = [];
                //     $notif['logo'] = $disdukcapil->cdn_picture;
                //     $notif['title'] = 'Notifikasi Usulan Baru';
                //     $notif['nama'] = $pemohon->name;
                //     $notif['no_telp'] = $pemohon->no_telp;
                //     $notif['no_perkara'] = $data['no_perkara'];
                //     $notif['alamat'] = $pemohon->alamat;
                //     $notif['email'] = $pemohon->email;
                //     $notif['jenis_perkara'] = $data['jenis_perkara'];
                //     $notif['nama_disdukcapil'] = $disdukcapil->nama;
                //     $notif['alamat_disdukcapil'] = $disdukcapil->alamat;
                //     $notif['no_telp_disdukcapil'] = $disdukcapil->no_telp;
                //     Mail::to($disdukcapil->email)->send(new NotifEmail($notif));
                // }


                return response([
                    'status' => true,
                    'message' => 'Data Berhasil Ditambah'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Data Gagal Ditambah'
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
    public function show(AktaKematianDetail $aktaKematianDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uid)
    {
        if (!PermissionCommon::check('akta_kematian.update')) abort(403);
        $aktaKematianDetail = AktaKematianDetail::find($uid);
        if ($aktaKematianDetail) {
            $uid = $aktaKematianDetail->uid;
            $data = $aktaKematianDetail;
            $pemohon = Pemohon::all();
            $disdukcapil = Disdukcapil::all();
            $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
            $body = view('pages.administrasi.usulan.akta_kematian.edit', compact('uid', 'data', 'pemohon', 'disdukcapil', 'provinces'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Usulan Perbaikan Akta',
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
    public function update(Request $request, $uid)
    {
        if (!PermissionCommon::check('akta_kematian.update')) abort(403);
        $aktaKematianDetail = AktaKematianDetail::find($uid);
        $request->validate([
            'no_perkara' => "required|unique:submissions,no_perkara," . $aktaKematianDetail->submission->uid . ",uid",
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nik_jenazah' => 'required',
            'nama_jenazah' => 'required',
            'wilayah_kelahiran' => 'required',
            'provinsi_kelahiran' => 'required',
            'tanggal_kematian' => 'required',
            'waktu_kematian' => 'required',
            'tempat_kematian' => 'required',
            'sebab_kematian' => 'required',
            'yang_menerangkan' => 'required',

            'nik_ayah' => 'required',
            'nama_ayah' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'nik_saksi1' => 'required',
            'nama_saksi1' => 'required',

            'file_penetapan_pengadilan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_pemohon' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_pemohon' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_surat_kematian' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',
            'nik_jenazah.required' => 'NIK Jenazah tidak boleh kosong',
            'nama_jenazah.required' => 'Nama Jenazah tidak boleh kosong',
            'wilayah_kelahiran.required' => 'Wilayah Kelahiran tidak boleh kosong',
            'provinsi_kelahiran.required' => 'Provinsi Kelahiran tidak boleh kosong',
            'tanggal_kematian.required' => 'Tanggal Kematian tidak boleh kosong',
            'waktu_kematian.required' => 'Waktu Kematian tidak boleh kosong',
            'tempat_kematian.required' => 'Tempat Kematian tidak boleh kosong',
            'sebab_kematian.required' => 'Sebab Kematian tidak boleh kosong',
            'yang_menerangkan.required' => 'Yang Menerangkan tidak boleh kosong',
            'nik_ayah.required' => 'NIK Ayah tidak boleh kosong',
            'nama_ayah.required' => 'Nama Ayah tidak boleh kosong',
            'nik_ibu.required' => 'NIK Ibu tidak boleh kosong',
            'nama_ibu.required' => 'Nama Ibu tidak boleh kosong',
            'nik_saksi1.required' => 'NIK Saksi 1 tidak boleh kosong',
            'nama_saksi1.required' => 'Nama Saksi 1 tidak boleh kosong',

            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_kk_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_pemohon.max' => 'Ukuran file KK Pemohon maksimal 2MB',

            'file_ktp_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_pemohon.max' => 'Ukuran file KTP Pemohon maksimal 2MB',

            'file_surat_kematian.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_surat_kematian.max' => 'Ukuran file Surat Kematian maksimal 2MB',

        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $documents = SubmissionDocument::where('submission_uid', $aktaKematianDetail->submission->uid)->get();
            foreach ($documents as $document) {
                if ($request->hasFile("file_" . $document->document_type)) {
                    $file = $request->file("file_" . $document->document_type);
                    $filename = md5($document->document_type . time()) . time() . '.' . $file->getClientOriginalExtension();

                    // Delete the old profile image if it exists
                    if ($document && file_exists(public_path("upload/file_$document->document_type/" . $document->file_path))) {
                        unlink(public_path("upload/file_$document->document_type/" . $document->file_path));
                    }

                    // Save the new file
                    $path = $file->move(public_path("upload/file_$document->document_type"), $filename);

                    // Update the form data with the new file name
                    $formData["path_$document->document_type"] = $filename;

                    $document->file_path = $filename;
                    $document->document_name = $file->getClientOriginalName();
                    $document->uploaded_at = date('Y-m-d H:i:s');
                    $document->save();
                }
            }

            $name = auth()->user()->name;
            $role = auth()->user()->role->name;
            $catatan = json_decode($aktaKematianDetail->submission->catatan);
            $catatan[] = [
                'role' => $role,
                'name' => $name,
                'status' => '4',
                'catatan' => $formData['catatan'],
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $aktaKematianDetail->submission->no_perkara = $formData['no_perkara'];
            $aktaKematianDetail->submission->pemohon_uid = $formData['pemohon_uid'];
            $aktaKematianDetail->submission->disdukcapil_uid = $formData['disdukcapil'];
            $aktaKematianDetail->submission->status = '1';
            $aktaKematianDetail->submission->catatan = json_encode($catatan);
            $aktaKematianDetail->submission->updated_by = auth()->user()->uid;
            $aktaKematianDetail->submission->save();

            $aktaKematianDetail->nik_jenazah = $formData['nik_jenazah'];
            $aktaKematianDetail->nama_jenazah = $formData['nama_jenazah'];
            $aktaKematianDetail->wilayah_kelahiran = $formData['wilayah_kelahiran'];
            $aktaKematianDetail->provinsi_kelahiran = $formData['provinsi_kelahiran'];
            $aktaKematianDetail->tanggal_kematian = $formData['tanggal_kematian'];
            $aktaKematianDetail->waktu_kematian = $formData['waktu_kematian'];
            $aktaKematianDetail->tempat_kematian = $formData['tempat_kematian'];
            $aktaKematianDetail->sebab_kematian = $formData['sebab_kematian'];
            $aktaKematianDetail->yang_menerangkan = $formData['yang_menerangkan'];
            $aktaKematianDetail->keterangan = $formData['keterangan'];
            $aktaKematianDetail->nik_ayah = $formData['nik_ayah'];
            $aktaKematianDetail->nama_ayah = $formData['nama_ayah'];
            $aktaKematianDetail->nik_ibu = $formData['nik_ibu'];
            $aktaKematianDetail->nama_ibu = $formData['nama_ibu'];
            $aktaKematianDetail->nik_saksi1 = $formData['nik_saksi1'];
            $aktaKematianDetail->nama_saksi1 = $formData['nama_saksi1'];
            $aktaKematianDetail->nik_saksi2 = $formData['nik_saksi2'] ?? null;
            $aktaKematianDetail->nama_saksi2 = $formData['nama_saksi2'] ?? null;

            $trx = $aktaKematianDetail->save();

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
    public function destroy($uid)
    {
        if (!PermissionCommon::check('akta_kematian.delete')) abort(403);
        $aktaKematianDetail = AktaKematianDetail::find($uid);
        if (!$aktaKematianDetail) {
            return response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        try {
            $documents = $aktaKematianDetail->submission->documents;
            foreach ($documents as $document) {
                // Delete the old profile image if it exists
                if ($document && file_exists(public_path("upload/file_$document->document_type/" . $document->file_path))) {
                    unlink(public_path("upload/file_$document->document_type/" . $document->file_path));
                }
            }
            $aktaKematianDetail->delete();
            $aktaKematianDetail->submission->documents()->delete();
            $aktaKematianDetail->submission->delete();
            return response([
                'status' => true,
                'message' => 'Data Berhasil Dihapus'
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        } catch (\Exception $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    public function showCatatan($uid)
    {
        try {
            $aktaKematianDetail = AktaKematianDetail::find($uid);
            if ($aktaKematianDetail) {
                $catatan = json_decode($aktaKematianDetail->submission->catatan);
                $body = view('pages.administrasi.usulan.akta_kematian.catatan', compact('aktaKematianDetail', 'catatan'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                return [
                    'title' => 'Lihat Catatan',
                    'body' => $body,
                    'footer' => $footer
                ];
            }
        } catch (\Throwable $th) {
            throw $th;
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }
}
