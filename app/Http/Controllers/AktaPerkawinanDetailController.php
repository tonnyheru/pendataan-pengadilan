<?php

namespace App\Http\Controllers;

use App\DataTables\AktaPerkawinanDetailDataTable;
use App\Helpers\PermissionCommon;
use App\Models\AktaPerkawinanDetail;
use App\Models\Disdukcapil;
use App\Models\Pemohon;
use App\Models\Submission;
use App\Models\SubmissionDocument;
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
        if (!PermissionCommon::check('akta_perkawinan.create')) abort(403);
        $request->validate([
            'no_perkara' => 'required|unique:submissions,no_perkara',
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nik_suami' => 'required',
            'kk_suami' => 'required',
            'nama_suami' => 'required',
            'kewarganegaraan_suami' => 'required',
            'alamat_suami' => 'required',
            'anak_ke_suami' => 'required',
            'perkawinan_ke_suami' => 'required',
            'istri_ke' => 'required',
            'nik_ayah_suami' => 'required',
            'nama_ayah_suami' => 'required',
            'nik_ibu_suami' => 'required',
            'nama_ibu_suami' => 'required',

            'nik_istri' => 'required',
            'kk_istri' => 'required',
            'nama_istri' => 'required',
            'kewarganegaraan_istri' => 'required',
            'alamat_istri' => 'required',
            'anak_ke_istri' => 'required',
            'perkawinan_ke_istri' => 'required',
            'nik_ayah_istri' => 'required',
            'nama_ayah_istri' => 'required',
            'nik_ibu_istri' => 'required',
            'nama_ibu_istri' => 'required',

            'nik_saksi1' => 'required',
            'nama_saksi1' => 'required',
            'nik_saksi2' => 'required',
            'nama_saksi2' => 'required',
            'tanggal_pemberkatan' => 'required',
            'tempat_pemberkatan' => 'required',
            'tanggal_lapor' => 'required',
            'waktu_lapor' => 'required',
            'agama' => 'required',
            'nama_pemuka_agama' => 'required',
            'no_putusan' => 'required',
            'tanggal_putusan' => 'required',

            'file_penetapan_pengadilan' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pemberkatan_nikah' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_suami' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_suami' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_istri' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_istri' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',

            'nik_suami.required' => 'NIK Suami tidak boleh kosong',
            'kk_suami.required' => 'KK Suami tidak boleh kosong',
            'nama_suami.required' => 'Nama Suami tidak boleh kosong',
            'kewarganegaraan_suami.required' => 'Kewarganegaraan Suami tidak boleh kosong',
            'alamat_suami.required' => 'Alamat Suami tidak boleh kosong',
            'anak_ke_suami.required' => 'Anak Ke Suami tidak boleh kosong',
            'perkawinan_ke_suami.required' => 'Perkawinan Ke Suami tidak boleh kosong',
            'istri_ke.required' => 'Istri Ke tidak boleh kosong',
            'nik_ayah_suami.required' => 'NIK Ayah Suami tidak boleh kosong',
            'nama_ayah_suami.required' => 'Nama Ayah Suami tidak boleh kosong',
            'nik_ibu_suami.required' => 'NIK Ibu Suami tidak boleh kosong',
            'nama_ibu_suami.required' => 'Nama Ibu Suami tidak boleh kosong',
            'nik_istri.required' => 'NIK Istri tidak boleh kosong',
            'kk_istri.required' => 'KK Istri tidak boleh kosong',
            'nama_istri.required' => 'Nama Istri tidak boleh kosong',
            'kewarganegaraan_istri.required' => 'Kewarganegaraan Istri tidak boleh kosong',
            'alamat_istri.required' => 'Alamat Istri tidak boleh kosong',
            'anak_ke_istri.required' => 'Anak Ke Istri tidak boleh kosong',
            'perkawinan_ke_istri.required' => 'Perkawinan Ke Istri tidak boleh kosong',
            'nik_ayah_istri.required' => 'NIK Ayah Istri tidak boleh kosong',
            'nama_ayah_istri.required' => 'Nama Ayah Istri tidak boleh kosong',
            'nik_ibu_istri.required' => 'NIK Ibu Istri tidak boleh kosong',
            'nama_ibu_istri.required' => 'Nama Ibu Istri tidak boleh kosong',

            'nik_saksi1.required' => 'NIK Saksi 1 tidak boleh kosong',
            'nama_saksi1.required' => 'Nama Saksi 1 tidak boleh kosong',
            'nik_saksi2.required' => 'NIK Saksi 2 tidak boleh kosong',
            'nama_saksi2.required' => 'Nama Saksi 2 tidak boleh kosong',
            'tanggal_pemberkatan.required' => 'Tanggal Pemberkatan tidak boleh kosong',
            'tempat_pemberkatan.required' => 'Tempat Pemberkatan tidak boleh kosong',
            'tanggal_lapor.required' => 'Tanggal Lapor tidak boleh kosong',
            'waktu_lapor.required' => 'Waktu Lapor tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'nama_pemuka_agama.required' => 'Nama Pemuka Agama tidak boleh kosong',
            'no_putusan.required' => 'Nomor Putusan tidak boleh kosong',
            'tanggal_putusan.required' => 'Tanggal Putusan tidak boleh kosong',

            'file_penetapan_pengadilan.required' => 'File Penetapan Pengadilan tidak boleh kosong',
            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_pemberkatan_nikah.required' => 'File Pemberkatan Nikah tidak boleh kosong',
            'file_pemberkatan_nikah.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pemberkatan_nikah.max' => 'Ukuran file pemberkatan nikah maksimal 2MB',

            'file_kk_suami.required' => 'File KK Suami tidak boleh kosong',
            'file_kk_suami.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_suami.max' => 'Ukuran file KK Suami maksimal 2MB',
            'file_ktp_suami.required' => 'File KTP Suami tidak boleh kosong',
            'file_ktp_suami.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_suami.max' => 'Ukuran file KTP Suami maksimal 2MB',

            'file_kk_istri.required' => 'File KK Istri tidak boleh kosong',
            'file_kk_istri.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_istri.max' => 'Ukuran file KK Istri maksimal 2MB',
            'file_ktp_istri.required' => 'File KTP Istri tidak boleh kosong',
            'file_ktp_istri.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_istri.max' => 'Ukuran file KTP Istri maksimal 2MB',

        ]);

        $data = $request->except('_token');
        try {
            $submission = Submission::create([
                'uid' => Str::uuid()->toString(),
                'no_perkara' => $data['no_perkara'],
                'submission_type' => 'akta_perkawinan',
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

            if ($request->hasFile('file_pemberkatan_nikah')) {
                $file_pemberkatan = $request->file('file_pemberkatan_nikah');
                $file_pemberkatan_name = md5('pemberkatan_nikah' . time()) . time() . '.' . $file_pemberkatan->getClientOriginalExtension();
                $data['path_pemberkatan'] = $file_pemberkatan_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_pemberkatan->getClientOriginalName(),
                    'document_type' => 'pemberkatan_nikah',
                    'file_path' => $file_pemberkatan_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }
            if ($request->hasFile('file_kk_suami')) {
                $file_kk_suami = $request->file('file_kk_suami');
                $file_kk_suami_name = md5('kk_suami' . time()) . time() . '.' . $file_kk_suami->getClientOriginalExtension();
                $data['path_kk_suami'] = $file_kk_suami_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_kk_suami->getClientOriginalName(),
                    'document_type' => 'kk_suami',
                    'file_path' => $file_kk_suami_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }
            if ($request->hasFile('file_ktp_suami')) {
                $file_ktp_suami = $request->file('file_ktp_suami');
                $file_ktp_suami_name = md5('ktp_suami' . time()) . time() . '.' . $file_ktp_suami->getClientOriginalExtension();
                $data['path_ktp_suami'] = $file_ktp_suami_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_ktp_suami->getClientOriginalName(),
                    'document_type' => 'ktp_suami',
                    'file_path' => $file_ktp_suami_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }
            if ($request->hasFile('file_kk_istri')) {
                $file_kk_istri = $request->file('file_kk_istri');
                $file_kk_istri_name = md5('kk_istri' . time()) . time() . '.' . $file_kk_istri->getClientOriginalExtension();
                $data['path_kk_istri'] = $file_kk_istri_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_kk_istri->getClientOriginalName(),
                    'document_type' => 'kk_istri',
                    'file_path' => $file_kk_istri_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }
            if ($request->hasFile('file_ktp_istri')) {
                $file_ktp_istri = $request->file('file_ktp_istri');
                $file_ktp_istri_name = md5('ktp_istri' . time()) . time() . '.' . $file_ktp_istri->getClientOriginalExtension();
                $data['path_ktp_istri'] = $file_ktp_istri_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_ktp_istri->getClientOriginalName(),
                    'document_type' => 'ktp_istri',
                    'file_path' => $file_ktp_istri_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }


            // status 0 = ditolak / revisi
            // status 1 = belum di approve
            // status 2 = sudah di approve disdukcapil


            $submission_document = SubmissionDocument::insert($documents);
            $trx = AktaPerkawinanDetail::create([
                'uid' => Str::uuid()->toString(),
                'submission_uid' => $submission->uid,
                'nik_suami' => $data['nik_suami'],
                'kk_suami' => $data['kk_suami'],
                'nama_suami' => $data['nama_suami'],
                'kewarganegaraan_suami' => $data['kewarganegaraan_suami'],
                'alamat_suami' => $data['alamat_suami'],
                'anak_ke_suami' => $data['anak_ke_suami'],
                'perkawinan_ke_suami' => $data['perkawinan_ke_suami'],
                'nama_istri_terakhir' => $data['nama_istri_terakhir'] ?? null,
                'istri_ke' => $data['istri_ke'],
                'nik_ayah_suami' => $data['nik_ayah_suami'],
                'nama_ayah_suami' => $data['nama_ayah_suami'],
                'nik_ibu_suami' => $data['nik_ibu_suami'],
                'nama_ibu_suami' => $data['nama_ibu_suami'],
                'nik_istri' => $data['nik_istri'],
                'kk_istri' => $data['kk_istri'],
                'nama_istri' => $data['nama_istri'],
                'kewarganegaraan_istri' => $data['kewarganegaraan_istri'],
                'alamat_istri' => $data['alamat_istri'],
                'anak_ke_istri' => $data['anak_ke_istri'],
                'perkawinan_ke_istri' => $data['perkawinan_ke_istri'],
                'nama_suami_terakhir' => $data['nama_suami_terakhir'] ?? null,
                'nik_ayah_istri' => $data['nik_ayah_istri'],
                'nama_ayah_istri' => $data['nama_ayah_istri'],
                'nik_ibu_istri' => $data['nik_ibu_istri'],
                'nama_ibu_istri' => $data['nama_ibu_istri'],
                'nik_saksi1' => $data['nik_saksi1'],
                'nama_saksi1' => $data['nama_saksi1'],
                'nik_saksi2' => $data['nik_saksi2'],
                'nama_saksi2' => $data['nama_saksi2'],
                'tanggal_pemberkatan' => $data['tanggal_pemberkatan'],
                'tempat_pemberkatan' => $data['tempat_pemberkatan'],
                'tanggal_lapor' => $data['tanggal_lapor'],
                'waktu_lapor' => $data['waktu_lapor'],
                'agama' => $data['agama'],
                'nama_pemuka_agama' => $data['nama_pemuka_agama'],
                'no_putusan' => $data['no_putusan'],
                'tanggal_putusan' => $data['tanggal_putusan'],
            ]);

            if ($trx) {
                if ($request->hasFile('file_penetapan_pengadilan')) {
                    $file_penetapan = $request->file('file_penetapan_pengadilan');
                    $file_penetapan->move(public_path('upload/file_penetapan_pengadilan'), $data['path_penetapan']);
                }
                if ($request->hasFile('file_pemberkatan_nikah')) {
                    $file_pemberkatan = $request->file('file_pemberkatan_nikah');
                    $file_pemberkatan->move(public_path('upload/file_pemberkatan_nikah'), $data['path_pemberkatan']);
                }
                if ($request->hasFile('file_kk_suami')) {
                    $file_kk_suami = $request->file('file_kk_suami');
                    $file_kk_suami->move(public_path('upload/file_kk_suami'), $data['path_kk_suami']);
                }
                if ($request->hasFile('file_ktp_suami')) {
                    $file_ktp_suami = $request->file('file_ktp_suami');
                    $file_ktp_suami->move(public_path('upload/file_ktp_suami'), $data['path_ktp_suami']);
                }
                if ($request->hasFile('file_kk_istri')) {
                    $file_kk_istri = $request->file('file_kk_istri');
                    $file_kk_istri->move(public_path('upload/file_kk_istri'), $data['path_kk_istri']);
                }
                if ($request->hasFile('file_ktp_istri')) {
                    $file_ktp_istri = $request->file('file_ktp_istri');
                    $file_ktp_istri->move(public_path('upload/file_ktp_istri'), $data['path_ktp_istri']);
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
    public function show(AktaPerkawinanDetail $aktaPerkawinanDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uid)
    {
        if (!PermissionCommon::check('akta_perkawinan.update')) abort(403);
        $aktaPerkawinanDetail = AktaPerkawinanDetail::find($uid);
        if ($aktaPerkawinanDetail) {
            $uid = $aktaPerkawinanDetail->uid;
            $data = $aktaPerkawinanDetail;
            $pemohon = Pemohon::all();
            $disdukcapil = Disdukcapil::all();
            $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
            $body = view('pages.administrasi.usulan.akta_perkawinan.edit', compact('uid', 'data', 'pemohon', 'disdukcapil', 'provinces'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Usulan Penerbitan Akta Perkawinan',
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
        if (!PermissionCommon::check('akta_perkawinan.update')) abort(403);
        $aktaPerkawinanDetail = AktaPerkawinanDetail::find($uid);
        $request->validate([
            'no_perkara' => "required|unique:submissions,no_perkara," . $aktaPerkawinanDetail->submission->uid . ",uid",
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nik_suami' => 'required',
            'kk_suami' => 'required',
            'nama_suami' => 'required',
            'kewarganegaraan_suami' => 'required',
            'alamat_suami' => 'required',
            'anak_ke_suami' => 'required',
            'perkawinan_ke_suami' => 'required',
            'istri_ke' => 'required',
            'nik_ayah_suami' => 'required',
            'nama_ayah_suami' => 'required',
            'nik_ibu_suami' => 'required',
            'nama_ibu_suami' => 'required',

            'nik_istri' => 'required',
            'kk_istri' => 'required',
            'nama_istri' => 'required',
            'kewarganegaraan_istri' => 'required',
            'alamat_istri' => 'required',
            'anak_ke_istri' => 'required',
            'perkawinan_ke_istri' => 'required',
            'nik_ayah_istri' => 'required',
            'nama_ayah_istri' => 'required',
            'nik_ibu_istri' => 'required',
            'nama_ibu_istri' => 'required',

            'nik_saksi1' => 'required',
            'nama_saksi1' => 'required',
            'nik_saksi2' => 'required',
            'nama_saksi2' => 'required',
            'tanggal_pemberkatan' => 'required',
            'tempat_pemberkatan' => 'required',
            'tanggal_lapor' => 'required',
            'waktu_lapor' => 'required',
            'agama' => 'required',
            'nama_pemuka_agama' => 'required',
            'no_putusan' => 'required',
            'tanggal_putusan' => 'required',

            'file_penetapan_pengadilan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pemberkatan_nikah' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_suami' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_suami' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_istri' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_istri' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',

            'nik_suami.required' => 'NIK Suami tidak boleh kosong',
            'kk_suami.required' => 'KK Suami tidak boleh kosong',
            'nama_suami.required' => 'Nama Suami tidak boleh kosong',
            'kewarganegaraan_suami.required' => 'Kewarganegaraan Suami tidak boleh kosong',
            'alamat_suami.required' => 'Alamat Suami tidak boleh kosong',
            'anak_ke_suami.required' => 'Anak Ke Suami tidak boleh kosong',
            'perkawinan_ke_suami.required' => 'Perkawinan Ke Suami tidak boleh kosong',
            'istri_ke.required' => 'Istri Ke tidak boleh kosong',
            'nik_ayah_suami.required' => 'NIK Ayah Suami tidak boleh kosong',
            'nama_ayah_suami.required' => 'Nama Ayah Suami tidak boleh kosong',
            'nik_ibu_suami.required' => 'NIK Ibu Suami tidak boleh kosong',
            'nama_ibu_suami.required' => 'Nama Ibu Suami tidak boleh kosong',
            'nik_istri.required' => 'NIK Istri tidak boleh kosong',
            'kk_istri.required' => 'KK Istri tidak boleh kosong',
            'nama_istri.required' => 'Nama Istri tidak boleh kosong',
            'kewarganegaraan_istri.required' => 'Kewarganegaraan Istri tidak boleh kosong',
            'alamat_istri.required' => 'Alamat Istri tidak boleh kosong',
            'anak_ke_istri.required' => 'Anak Ke Istri tidak boleh kosong',
            'perkawinan_ke_istri.required' => 'Perkawinan Ke Istri tidak boleh kosong',
            'nik_ayah_istri.required' => 'NIK Ayah Istri tidak boleh kosong',
            'nama_ayah_istri.required' => 'Nama Ayah Istri tidak boleh kosong',
            'nik_ibu_istri.required' => 'NIK Ibu Istri tidak boleh kosong',
            'nama_ibu_istri.required' => 'Nama Ibu Istri tidak boleh kosong',

            'nik_saksi1.required' => 'NIK Saksi 1 tidak boleh kosong',
            'nama_saksi1.required' => 'Nama Saksi 1 tidak boleh kosong',
            'nik_saksi2.required' => 'NIK Saksi 2 tidak boleh kosong',
            'nama_saksi2.required' => 'Nama Saksi 2 tidak boleh kosong',
            'tanggal_pemberkatan.required' => 'Tanggal Pemberkatan tidak boleh kosong',
            'tempat_pemberkatan.required' => 'Tempat Pemberkatan tidak boleh kosong',
            'tanggal_lapor.required' => 'Tanggal Lapor tidak boleh kosong',
            'waktu_lapor.required' => 'Waktu Lapor tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'nama_pemuka_agama.required' => 'Nama Pemuka Agama tidak boleh kosong',
            'no_putusan.required' => 'Nomor Putusan tidak boleh kosong',
            'tanggal_putusan.required' => 'Tanggal Putusan tidak boleh kosong',

            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_pemberkatan_nikah.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pemberkatan_nikah.max' => 'Ukuran file pemberkatan nikah maksimal 2MB',

            'file_kk_suami.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_suami.max' => 'Ukuran file KK Suami maksimal 2MB',

            'file_ktp_suami.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_suami.max' => 'Ukuran file KTP Suami maksimal 2MB',

            'file_kk_istri.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_istri.max' => 'Ukuran file KK Istri maksimal 2MB',

            'file_ktp_istri.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_istri.max' => 'Ukuran file KTP Istri maksimal 2MB',

        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $documents = SubmissionDocument::where('submission_uid', $aktaPerkawinanDetail->submission->uid)->get();
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
            $catatan = json_decode($aktaPerkawinanDetail->submission->catatan);
            $catatan[] = [
                'role' => $role,
                'name' => $name,
                'status' => '4',
                'catatan' => $formData['catatan'],
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $aktaPerkawinanDetail->submission->no_perkara = $formData['no_perkara'];
            $aktaPerkawinanDetail->submission->pemohon_uid = $formData['pemohon_uid'];
            $aktaPerkawinanDetail->submission->disdukcapil_uid = $formData['disdukcapil'];
            $aktaPerkawinanDetail->submission->status = '1';
            $aktaPerkawinanDetail->submission->catatan = json_encode($catatan);
            $aktaPerkawinanDetail->submission->updated_by = auth()->user()->uid;
            $aktaPerkawinanDetail->submission->save();


            $aktaPerkawinanDetail->nik_suami = $formData['nik_suami'];
            $aktaPerkawinanDetail->kk_suami = $formData['kk_suami'];
            $aktaPerkawinanDetail->nama_suami = $formData['nama_suami'];
            $aktaPerkawinanDetail->kewarganegaraan_suami = $formData['kewarganegaraan_suami'];
            $aktaPerkawinanDetail->alamat_suami = $formData['alamat_suami'];
            $aktaPerkawinanDetail->anak_ke_suami = $formData['anak_ke_suami'];
            $aktaPerkawinanDetail->perkawinan_ke_suami = $formData['perkawinan_ke_suami'];
            $aktaPerkawinanDetail->nama_istri_terakhir = $formData['nama_istri_terakhir'] ?? null;
            $aktaPerkawinanDetail->istri_ke = $formData['istri_ke'];
            $aktaPerkawinanDetail->nik_ayah_suami = $formData['nik_ayah_suami'];
            $aktaPerkawinanDetail->nama_ayah_suami = $formData['nama_ayah_suami'];
            $aktaPerkawinanDetail->nik_ibu_suami = $formData['nik_ibu_suami'];
            $aktaPerkawinanDetail->nama_ibu_suami = $formData['nama_ibu_suami'];
            $aktaPerkawinanDetail->nik_istri = $formData['nik_istri'];
            $aktaPerkawinanDetail->kk_istri = $formData['kk_istri'];
            $aktaPerkawinanDetail->nama_istri = $formData['nama_istri'];
            $aktaPerkawinanDetail->kewarganegaraan_istri = $formData['kewarganegaraan_istri'];
            $aktaPerkawinanDetail->alamat_istri = $formData['alamat_istri'];
            $aktaPerkawinanDetail->anak_ke_istri = $formData['anak_ke_istri'];
            $aktaPerkawinanDetail->perkawinan_ke_istri = $formData['perkawinan_ke_istri'];
            $aktaPerkawinanDetail->nama_suami_terakhir = $formData['nama_suami_terakhir'] ?? null;
            $aktaPerkawinanDetail->nik_ayah_istri = $formData['nik_ayah_istri'];
            $aktaPerkawinanDetail->nama_ayah_istri = $formData['nama_ayah_istri'];
            $aktaPerkawinanDetail->nik_ibu_istri = $formData['nik_ibu_istri'];
            $aktaPerkawinanDetail->nama_ibu_istri = $formData['nama_ibu_istri'];
            $aktaPerkawinanDetail->nik_saksi1 = $formData['nik_saksi1'];
            $aktaPerkawinanDetail->nama_saksi1 = $formData['nama_saksi1'];
            $aktaPerkawinanDetail->nik_saksi2 = $formData['nik_saksi2'];
            $aktaPerkawinanDetail->nama_saksi2 = $formData['nama_saksi2'];
            $aktaPerkawinanDetail->tanggal_pemberkatan = $formData['tanggal_pemberkatan'];
            $aktaPerkawinanDetail->tempat_pemberkatan = $formData['tempat_pemberkatan'];
            $aktaPerkawinanDetail->tanggal_lapor = $formData['tanggal_lapor'];
            $aktaPerkawinanDetail->waktu_lapor = $formData['waktu_lapor'];
            $aktaPerkawinanDetail->agama = $formData['agama'];
            $aktaPerkawinanDetail->nama_pemuka_agama = $formData['nama_pemuka_agama'];
            $aktaPerkawinanDetail->no_putusan = $formData['no_putusan'];
            $aktaPerkawinanDetail->tanggal_putusan = $formData['tanggal_putusan'];

            $trx = $aktaPerkawinanDetail->save();

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
        if (!PermissionCommon::check('akta_perkawinan.delete')) abort(403);
        $aktaPerkawinanDetail = AktaPerkawinanDetail::find($uid);
        if (!$aktaPerkawinanDetail) {
            return response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        try {
            $documents = $aktaPerkawinanDetail->submission->documents;
            foreach ($documents as $document) {
                // Delete the old profile image if it exists
                if ($document && file_exists(public_path("upload/file_$document->document_type/" . $document->file_path))) {
                    unlink(public_path("upload/file_$document->document_type/" . $document->file_path));
                }
            }
            $aktaPerkawinanDetail->delete();
            $aktaPerkawinanDetail->submission->documents()->delete();
            $aktaPerkawinanDetail->submission->delete();
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
            $aktaPerkawinanDetail = AktaPerkawinanDetail::find($uid);
            if ($aktaPerkawinanDetail) {
                $catatan = json_decode($aktaPerkawinanDetail->submission->catatan);
                $body = view('pages.administrasi.usulan.akta_perkawinan.catatan', compact('aktaPerkawinanDetail', 'catatan'))->render();
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
