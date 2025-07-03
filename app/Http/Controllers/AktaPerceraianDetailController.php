<?php

namespace App\Http\Controllers;

use App\DataTables\AktaPerceraianDetailDataTable;
use App\Helpers\PermissionCommon;
use App\Helpers\WhatsappHelper;
use App\Mail\NotifEmail;
use App\Models\AktaPerceraianDetail;
use App\Models\Disdukcapil;
use App\Models\Pemohon;
use App\Models\Submission;
use App\Models\SubmissionDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use GuzzleHttp\Client as GuzzleClient;

class AktaPerceraianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AktaPerceraianDetailDataTable $dataTable)
    {
        if (!PermissionCommon::check('akta_perceraian.list')) abort(403);
        return $dataTable->render('pages.administrasi.usulan.akta_perceraian.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('akta_perceraian.create')) abort(403);
        $pemohon = Pemohon::all();
        $disdukcapil = Disdukcapil::all();
        $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
        $body = view('pages.administrasi.usulan.akta_perceraian.create', compact('pemohon', 'disdukcapil', 'provinces'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Tambah Usulan Penerbitan Akta Perceraian',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!PermissionCommon::check('akta_perceraian.create')) abort(403);
        $request->validate([
            'no_perkara' => 'required|unique:submissions,no_perkara',
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nik_suami' => 'required',
            'kk_suami' => 'required',
            'nama_suami' => 'required',
            'tempat_lahir_suami' => 'required',
            'tanggal_lahir_suami' => 'required',
            'alamat_suami' => 'required',
            'perceraian_ke' => 'required',
            'kewarganegaraan_suami' => 'required',

            'nik_istri' => 'required',
            'kk_istri' => 'required',
            'nama_istri' => 'required',
            'tempat_lahir_istri' => 'required',
            'tanggal_lahir_istri' => 'required',
            'alamat_istri' => 'required',
            'kewarganegaraan_istri' => 'required',

            'yang_mengajukan' => 'required',
            'no_akta_kawin' => 'required',
            'tanggal_akta_kawin' => 'required',
            'tempat_perkawinan' => 'required',
            'no_putusan' => 'required',
            'tanggal_putusan' => 'required',
            'sebab_perceraian' => 'required',
            'tanggal_lapor' => 'required',
            'waktu_lapor' => 'required',

            'file_penetapan_pengadilan' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta_perkawinan' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
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
            'tempat_lahir_suami.required' => 'Tempat Lahir Suami tidak boleh kosong',
            'tanggal_lahir_suami.required' => 'Tanggal Lahir Suami tidak boleh kosong',
            'alamat_suami.required' => 'Alamat Suami tidak boleh kosong',
            'perceraian_ke.required' => 'Perceraian Ke Suami tidak boleh kosong',
            'kewarganegaraan_suami.required' => 'Kewarganegaraan Suami tidak boleh kosong',

            'nik_istri.required' => 'NIK Istri tidak boleh kosong',
            'kk_istri.required' => 'KK Istri tidak boleh kosong',
            'nama_istri.required' => 'Nama Istri tidak boleh kosong',
            'tempat_lahir_istri.required' => 'Tempat Lahir Istri tidak boleh kosong',
            'tanggal_lahir_istri.required' => 'Tanggal Lahir Istri tidak boleh kosong',
            'alamat_istri.required' => 'Alamat Istri tidak boleh kosong',
            'kewarganegaraan_istri.required' => 'Kewarganegaraan Istri tidak boleh kosong',

            'yang_mengajukan.required' => 'Yang Mengajukan tidak boleh kosong',
            'no_akta_kawin.required' => 'Nomor Akta Kawin tidak boleh kosong',
            'tanggal_akta_kawin.required' => 'Tanggal Akta Kawin tidak boleh kosong',
            'tempat_perkawinan.required' => 'Tempat Perkawinan tidak boleh kosong',
            'no_putusan.required' => 'Nomor Putusan tidak boleh kosong',
            'tanggal_putusan.required' => 'Tanggal Putusan tidak boleh kosong',
            'sebab_perceraian.required' => 'Sebab Perceraian tidak boleh kosong',
            'tanggal_lapor.required' => 'Tanggal Lapor tidak boleh kosong',
            'waktu_lapor.required' => 'Waktu Lapor tidak boleh kosong',

            'file_penetapan_pengadilan.required' => 'File Penetapan Pengadilan tidak boleh kosong',
            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2',

            'file_akta_perkawinan.required' => 'File Akta Perkawinan tidak boleh kosong',
            'file_akta_perkawinan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta_perkawinan.max' => 'Ukuran file akta perkawinan maksimal 2MB',

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
                'submission_type' => 'akta_perceraian',
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

            if ($request->hasFile('file_akta_perkawinan')) {
                $file_akta_perkawinan = $request->file('file_akta_perkawinan');
                $file_akta_perkawinan_name = md5('akta_perkawinan' . time()) . time() . '.' . $file_akta_perkawinan->getClientOriginalExtension();
                $data['path_akta_perkawinan'] = $file_akta_perkawinan_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_akta_perkawinan->getClientOriginalName(),
                    'document_type' => 'akta_perkawinan',
                    'file_path' => $file_akta_perkawinan_name,
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
            $trx = AktaPerceraianDetail::create([
                'uid' => Str::uuid()->toString(),
                'submission_uid' => $submission->uid,
                'nik_suami' => $data['nik_suami'],
                'kk_suami' => $data['kk_suami'],
                'paspor_suami' => $data['paspor_suami'] ?? null,
                'nama_suami' => $data['nama_suami'],
                'tempat_lahir_suami' => $data['tempat_lahir_suami'],
                'tanggal_lahir_suami' => $data['tanggal_lahir_suami'],
                'alamat_suami' => $data['alamat_suami'],
                'perceraian_ke' => $data['perceraian_ke'],
                'kewarganegaraan_suami' => $data['kewarganegaraan_suami'],

                'nik_istri' => $data['nik_istri'],
                'kk_istri' => $data['kk_istri'],
                'paspor_istri' => $data['paspor_istri'] ?? null,
                'nama_istri' => $data['nama_istri'],
                'tempat_lahir_istri' => $data['tempat_lahir_istri'],
                'tanggal_lahir_istri' => $data['tanggal_lahir_istri'],
                'alamat_istri' => $data['alamat_istri'],
                'kewarganegaraan_istri' => $data['kewarganegaraan_istri'],

                'yang_mengajukan' => $data['yang_mengajukan'],
                'no_akta_kawin' => $data['no_akta_kawin'],
                'tanggal_akta_kawin' => $data['tanggal_akta_kawin'],
                'tempat_perkawinan' => $data['tempat_perkawinan'],
                'no_putusan' => $data['no_putusan'],
                'tanggal_putusan' => $data['tanggal_putusan'],
                'sebab_perceraian' => $data['sebab_perceraian'],
                'tanggal_lapor' => $data['tanggal_lapor'],
                'waktu_lapor' => $data['waktu_lapor'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);

            if ($trx) {
                if ($request->hasFile('file_penetapan_pengadilan')) {
                    $file_penetapan = $request->file('file_penetapan_pengadilan');
                    $file_penetapan->move(public_path('upload/file_penetapan_pengadilan'), $data['path_penetapan']);
                }
                if ($request->hasFile('file_akta_perkawinan')) {
                    $file_akta_perkawinan = $request->file('file_akta_perkawinan');
                    $file_akta_perkawinan->move(public_path('upload/file_akta_perkawinan'), $data['path_akta_perkawinan']);
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

                $disdukcapil = Disdukcapil::find($data['disdukcapil']);
                $pemohon = Pemohon::find($data['pemohon_uid']);
                if ($disdukcapil) {
                    $notif = [];
                    $notif['logo'] = $disdukcapil->cdn_picture;
                    $notif['title'] = 'Notifikasi Usulan Baru';
                    $notif['nama'] = $pemohon->name;
                    $notif['no_telp'] = $pemohon->no_telp;
                    $notif['no_perkara'] = $data['no_perkara'];
                    $notif['alamat'] = $pemohon->alamat;
                    $notif['email'] = $pemohon->email;
                    $notif['jenis_perkara'] = "Penerbitan Akta Perceraian";
                    $notif['nama_disdukcapil'] = $disdukcapil->nama;
                    $notif['alamat_disdukcapil'] = $disdukcapil->alamat;
                    $notif['no_telp_disdukcapil'] = $disdukcapil->no_telp;
                    $notif['tanggal_pengajuan'] = date('d-m-Y H:i:s');
                    Mail::to($disdukcapil->email)->send(new NotifEmail($notif));
                    $nama_disdukcapil = $disdukcapil->nama;
                    $nama_pemohon = $pemohon->name;
                    $nomor_perkara = $data['no_perkara'];
                    $tanggal_pengajuan = date('d-m-Y H:i:s');
                    $jenis_permohonan = "Penerbitan Akta Perceraian";
                    $message = <<<EOT
                    Yth. $nama_disdukcapil,

                    Kami informasikan bahwa usulan pemohon terkait perkara perdata catatan sipil yang telah dikirimkan oleh Pengadilan Negeri Bale Bandung. Kami mohon agar Disdukcapil dapat segera menindaklanjuti usulan yang telah diajukan.

                    Informasi Terkait Usulan yang Dikirimkan:

                    📝 Nama Pemohon      : $nama_pemohon
                    📑 Nomor Perkara     : $nomor_perkara
                    📅 Tanggal Pengajuan : $tanggal_pengajuan
                    🗃 Jenis Permohonan  : $jenis_permohonan

                    Terima kasih atas kerjasamanya.
                    Pengadilan Negeri Bale Bandung
                    EOT;
                    WhatsappHelper::sendSingleMessage($disdukcapil->no_telp, $message);

                    if (strtolower($disdukcapil->nama) == "disdukcapil kota cimahi") {
                        // Lakukan sesuatu jika Disdukcapil adalah Kota Cimahi
                        $client = new GuzzleClient([
                            'http_errors' => false
                        ]);
                        $url = 'https://gsb.cimahikota.go.id/api/disdukcapil/pn_bale_bandung/perbaikan_data';
                        $response = $client->request('POST', $url, ['headers' => [], 'json' => []]);
                        $status = $response->getStatusCode();
                        echo $response->getBody();
                    }
                }


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
    public function show(AktaPerceraianDetail $aktaPerceraianDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uid)
    {
        if (!PermissionCommon::check('akta_perceraian.update')) abort(403);
        $aktaPerceraianDetail = AktaPerceraianDetail::find($uid);
        if ($aktaPerceraianDetail) {
            $uid = $aktaPerceraianDetail->uid;
            $data = $aktaPerceraianDetail;
            $pemohon = Pemohon::all();
            $disdukcapil = Disdukcapil::all();
            $body = view('pages.administrasi.usulan.akta_perceraian.edit', compact('uid', 'data', 'pemohon', 'disdukcapil'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Usulan Penerbitan Akta Perceraian',
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
        if (!PermissionCommon::check('akta_perceraian.update')) abort(403);
        $aktaPerceraianDetail = AktaPerceraianDetail::find($uid);
        $request->validate([
            'no_perkara' => "required|unique:submissions,no_perkara," . $aktaPerceraianDetail->submission->uid . ",uid",
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nik_suami' => 'required',
            'kk_suami' => 'required',
            'nama_suami' => 'required',
            'tempat_lahir_suami' => 'required',
            'tanggal_lahir_suami' => 'required',
            'alamat_suami' => 'required',
            'perceraian_ke' => 'required',
            'kewarganegaraan_suami' => 'required',

            'nik_istri' => 'required',
            'kk_istri' => 'required',
            'nama_istri' => 'required',
            'tempat_lahir_istri' => 'required',
            'tanggal_lahir_istri' => 'required',
            'alamat_istri' => 'required',
            'kewarganegaraan_istri' => 'required',

            'yang_mengajukan' => 'required',
            'no_akta_kawin' => 'required',
            'tanggal_akta_kawin' => 'required',
            'tempat_perkawinan' => 'required',
            'no_putusan' => 'required',
            'tanggal_putusan' => 'required',
            'sebab_perceraian' => 'required',
            'tanggal_lapor' => 'required',
            'waktu_lapor' => 'required',

            'file_penetapan_pengadilan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta_perkawinan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
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
            'tempat_lahir_suami.required' => 'Tempat Lahir Suami tidak boleh kosong',
            'tanggal_lahir_suami.required' => 'Tanggal Lahir Suami tidak boleh kosong',
            'alamat_suami.required' => 'Alamat Suami tidak boleh kosong',
            'perceraian_ke.required' => 'Perceraian Ke Suami tidak boleh kosong',
            'kewarganegaraan_suami.required' => 'Kewarganegaraan Suami tidak boleh kosong',

            'nik_istri.required' => 'NIK Istri tidak boleh kosong',
            'kk_istri.required' => 'KK Istri tidak boleh kosong',
            'nama_istri.required' => 'Nama Istri tidak boleh kosong',
            'tempat_lahir_istri.required' => 'Tempat Lahir Istri tidak boleh kosong',
            'tanggal_lahir_istri.required' => 'Tanggal Lahir Istri tidak boleh kosong',
            'alamat_istri.required' => 'Alamat Istri tidak boleh kosong',
            'kewarganegaraan_istri.required' => 'Kewarganegaraan Istri tidak boleh kosong',

            'yang_mengajukan.required' => 'Yang Mengajukan tidak boleh kosong',
            'no_akta_kawin.required' => 'Nomor Akta Kawin tidak boleh kosong',
            'tanggal_akta_kawin.required' => 'Tanggal Akta Kawin tidak boleh kosong',
            'tempat_perkawinan.required' => 'Tempat Perkawinan tidak boleh kosong',
            'no_putusan.required' => 'Nomor Putusan tidak boleh kosong',
            'tanggal_putusan.required' => 'Tanggal Putusan tidak boleh kosong',
            'sebab_perceraian.required' => 'Sebab Perceraian tidak boleh kosong',
            'tanggal_lapor.required' => 'Tanggal Lapor tidak boleh kosong',
            'waktu_lapor.required' => 'Waktu Lapor tidak boleh kosong',

            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2',

            'file_akta_perkawinan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta_perkawinan.max' => 'Ukuran file akta perkawinan maksimal 2MB',

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
            $documents = SubmissionDocument::where('submission_uid', $aktaPerceraianDetail->submission->uid)->get();
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
            $catatan = json_decode($aktaPerceraianDetail->submission->catatan);
            $catatan[] = [
                'role' => $role,
                'name' => $name,
                'status' => '4',
                'catatan' => $formData['catatan'],
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $aktaPerceraianDetail->submission->no_perkara = $formData['no_perkara'];
            $aktaPerceraianDetail->submission->pemohon_uid = $formData['pemohon_uid'];
            $aktaPerceraianDetail->submission->disdukcapil_uid = $formData['disdukcapil'];
            $aktaPerceraianDetail->submission->status = '1';
            $aktaPerceraianDetail->submission->catatan = json_encode($catatan);
            $aktaPerceraianDetail->submission->updated_by = auth()->user()->uid;
            $aktaPerceraianDetail->submission->save();


            $aktaPerceraianDetail->nik_suami = $formData['nik_suami'];
            $aktaPerceraianDetail->kk_suami = $formData['kk_suami'];
            $aktaPerceraianDetail->paspor_suami = $formData['paspor_suami'] ?? null;
            $aktaPerceraianDetail->nama_suami = $formData['nama_suami'];
            $aktaPerceraianDetail->tempat_lahir_suami = $formData['tempat_lahir_suami'];
            $aktaPerceraianDetail->tanggal_lahir_suami = $formData['tanggal_lahir_suami'];
            $aktaPerceraianDetail->alamat_suami = $formData['alamat_suami'];
            $aktaPerceraianDetail->perceraian_ke = $formData['perceraian_ke'];
            $aktaPerceraianDetail->kewarganegaraan_suami = $formData['kewarganegaraan_suami'];

            $aktaPerceraianDetail->nik_istri = $formData['nik_istri'];
            $aktaPerceraianDetail->kk_istri = $formData['kk_istri'];
            $aktaPerceraianDetail->paspor_istri = $formData['paspor_istri'] ?? null;
            $aktaPerceraianDetail->nama_istri = $formData['nama_istri'];
            $aktaPerceraianDetail->tempat_lahir_istri = $formData['tempat_lahir_istri'];
            $aktaPerceraianDetail->tanggal_lahir_istri = $formData['tanggal_lahir_istri'];
            $aktaPerceraianDetail->alamat_istri = $formData['alamat_istri'];
            $aktaPerceraianDetail->kewarganegaraan_istri = $formData['kewarganegaraan_istri'];

            $aktaPerceraianDetail->yang_mengajukan = $formData['yang_mengajukan'];
            $aktaPerceraianDetail->no_akta_kawin = $formData['no_akta_kawin'];
            $aktaPerceraianDetail->tanggal_akta_kawin = $formData['tanggal_akta_kawin'];
            $aktaPerceraianDetail->tempat_perkawinan = $formData['tempat_perkawinan'];
            $aktaPerceraianDetail->no_putusan = $formData['no_putusan'];
            $aktaPerceraianDetail->tanggal_putusan = $formData['tanggal_putusan'];
            $aktaPerceraianDetail->sebab_perceraian = $formData['sebab_perceraian'];
            $aktaPerceraianDetail->tanggal_lapor = $formData['tanggal_lapor'];
            $aktaPerceraianDetail->waktu_lapor = $formData['waktu_lapor'];
            $aktaPerceraianDetail->keterangan = $formData['keterangan'] ?? null;

            $trx = $aktaPerceraianDetail->save();

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
        if (!PermissionCommon::check('akta_perceraian.delete')) abort(403);
        $aktaPerceraianDetail = AktaPerceraianDetail::find($uid);
        if (!$aktaPerceraianDetail) {
            return response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        try {
            $documents = $aktaPerceraianDetail->submission->documents;
            foreach ($documents as $document) {
                // Delete the old profile image if it exists
                if ($document && file_exists(public_path("upload/file_$document->document_type/" . $document->file_path))) {
                    unlink(public_path("upload/file_$document->document_type/" . $document->file_path));
                }
            }
            $aktaPerceraianDetail->delete();
            $aktaPerceraianDetail->submission->documents()->delete();
            $aktaPerceraianDetail->submission->delete();
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
            $aktaPerceraianDetail = AktaPerceraianDetail::find($uid);
            if ($aktaPerceraianDetail) {
                $catatan = json_decode($aktaPerceraianDetail->submission->catatan);
                $body = view('pages.administrasi.usulan.akta_perceraian.catatan', compact('aktaPerceraianDetail', 'catatan'))->render();
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
