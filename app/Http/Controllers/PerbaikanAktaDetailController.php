<?php

namespace App\Http\Controllers;

use App\DataTables\PerbaikanAktaDetailDataTable;
use App\Helpers\DataHelper;
use App\Helpers\PermissionCommon;
use App\Helpers\WhatsappHelper;
use App\Mail\NotifEmail;
use App\Mail\NotifEmailCust;
use App\Models\Disdukcapil;
use App\Models\Pemohon;
use App\Models\PerbaikanAktaDetail;
use App\Models\Submission;
use App\Models\SubmissionDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use GuzzleHttp\Client as GuzzleClient;

class PerbaikanAktaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PerbaikanAktaDetailDataTable $dataTable)
    {
        if (!PermissionCommon::check('perbaikan_akta.list')) abort(403);
        return $dataTable->render('pages.administrasi.usulan.perbaikan_akta.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('perbaikan_akta.create')) abort(403);
        $pemohon = Pemohon::all();
        $disdukcapil = Disdukcapil::all();

        $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
        $body = view('pages.administrasi.usulan.perbaikan_akta.create', compact('pemohon', 'disdukcapil', 'provinces'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Tambah Usulan Perbaikan Akta',
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
            'jenis_akta' => 'required',
            'no_akta' => 'required',
            'jenis_elemen_perbaikan' => 'required',
            'data_sebelum' => 'required',
            'data_sesudah' => 'required',

            'subject.province' => 'required_if:disdukcapil_nama,Disdukcapil Kota Cimahi',
            'subject.regency' => 'required_if:disdukcapil_nama,Disdukcapil Kota Cimahi',
            'subject.district' => 'required_if:disdukcapil_nama,Disdukcapil Kota Cimahi',
            'subject.village' => 'required_if:disdukcapil_nama,Disdukcapil Kota Cimahi',
            'subject.nik' => 'required_if:disdukcapil_nama,Disdukcapil Kota Cimahi',
            'subject.name' => 'required_if:disdukcapil_nama,Disdukcapil Kota Cimahi',

            'file_penetapan_pengadilan' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta_kelahiran' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_pemohon' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_pemohon' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_keabsahan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',
            'jenis_akta.required' => 'Jenis Akta tidak boleh kosong',
            'no_akta.required' => 'Nomor Akta tidak boleh kosong',
            'jenis_elemen_perbaikan.required' => 'Jenis Elemen Perbaikan tidak boleh kosong',
            'data_sebelum.required' => 'Data Sebelum tidak boleh kosong',
            'data_sesudah.required' => 'Data Sesudah tidak boleh kosong',

            'subject.province.required' => 'Provinsi tidak boleh kosong',
            'subject.regency.required' => 'Kabupaten / Kota tidak boleh kosong',
            'subject.district.required' => 'Kecamatan tidak boleh kosong',
            'subject.village.required' => 'Desa / Kelurahan tidak boleh kosong',
            'subject.nik.required' => 'NIK tidak boleh kosong',
            'subject.name.required' => 'Nama tidak boleh kosong',

            'file_penetapan_pengadilan.required' => 'File Penetapan Pengadilan tidak boleh kosong',
            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_akta_kelahiran.required' => 'File Akta Kelahiran tidak boleh kosong',
            'file_akta_kelahiran.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta_kelahiran.max' => 'Ukuran file akta kelahiran maksimal 2MB',

            'file_kk_pemohon.required' => 'File KK Pemohon tidak boleh kosong',
            'file_kk_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_pemohon.max' => 'Ukuran file KK Pemohon maksimal 2MB',

            'file_ktp_pemohon.required' => 'File KTP Pemohon tidak boleh kosong',
            'file_ktp_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_pemohon.max' => 'Ukuran file KTP Pemohon maksimal 2MB',

            'file_keabsahan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_keabsahan.max' => 'Ukuran file keabsahan maksimal 2MB',
        ]);

        $data = $request->except('_token');
        try {
            $submission = Submission::create([
                'uid' => Str::uuid()->toString(),
                'no_perkara' => $data['no_perkara'],
                'submission_type' => 'perbaikan_akta',
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

            if ($request->hasFile('file_akta_kelahiran')) {
                $file_akta_kelahiran = $request->file('file_akta_kelahiran');
                $file_akta_kelahiran_name = md5('akta_kelahiran' . time()) . time() . '.' . $file_akta_kelahiran->getClientOriginalExtension();
                $data['path_akta_kelahiran'] = $file_akta_kelahiran_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_akta_kelahiran->getClientOriginalName(),
                    'document_type' => 'akta_kelahiran',
                    'file_path' => $file_akta_kelahiran_name,
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

            if ($request->hasFile('file_keabsahan')) {
                $file_keabsahan = $request->file('file_keabsahan');
                $file_keabsahan_name = md5('keabsahan' . time()) . time() . '.' . $file_keabsahan->getClientOriginalExtension();
                $data['path_keabsahan'] = $file_keabsahan_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_keabsahan->getClientOriginalName(),
                    'document_type' => 'keabsahan',
                    'file_path' => $file_keabsahan_name,
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

            if ($request->hasFile('file_akta_perceraian')) {
                $file_akta_perceraian = $request->file('file_akta_perceraian');
                $file_akta_perceraian_name = md5('akta_perceraian' . time()) . time() . '.' . $file_akta_perceraian->getClientOriginalExtension();
                $data['path_akta_perceraian'] = $file_akta_perceraian_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_akta_perceraian->getClientOriginalName(),
                    'document_type' => 'akta_perceraian',
                    'file_path' => $file_akta_perceraian_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_keterangan_medis')) {
                $file_keterangan_medis = $request->file('file_keterangan_medis');
                $file_keterangan_medis_name = md5('keterangan_medis' . time()) . time() . '.' . $file_keterangan_medis->getClientOriginalExtension();
                $data['path_keterangan_medis'] = $file_keterangan_medis_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_keterangan_medis->getClientOriginalName(),
                    'document_type' => 'keterangan_medis',
                    'file_path' => $file_keterangan_medis_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_ijazah')) {
                $file_ijazah = $request->file('file_ijazah');
                $file_ijazah_name = md5('ijazah' . time()) . time() . '.' . $file_ijazah->getClientOriginalExtension();
                $data['path_ijazah'] = $file_ijazah_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_ijazah->getClientOriginalName(),
                    'document_type' => 'ijazah',
                    'file_path' => $file_ijazah_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_keterangan_status_pekerjaan')) {
                $file_keterangan_status_pekerjaan = $request->file('file_keterangan_status_pekerjaan');
                $file_keterangan_status_pekerjaan_name = md5('keterangan_status_pekerjaan' . time()) . time() . '.' . $file_keterangan_status_pekerjaan->getClientOriginalExtension();
                $data['path_keterangan_status_pekerjaan'] = $file_keterangan_status_pekerjaan_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_keterangan_status_pekerjaan->getClientOriginalName(),
                    'document_type' => 'keterangan_status_pekerjaan',
                    'file_path' => $file_keterangan_status_pekerjaan_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_paspor')) {
                $file_paspor = $request->file('file_paspor');
                $file_paspor_name = md5('paspor' . time()) . time() . '.' . $file_paspor->getClientOriginalExtension();
                $data['path_paspor'] = $file_paspor_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_paspor->getClientOriginalName(),
                    'document_type' => 'paspor',
                    'file_path' => $file_paspor_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_sptjm')) {
                $file_sptjm = $request->file('file_sptjm');
                $file_sptjm_name = md5('sptjm' . time()) . time() . '.' . $file_sptjm->getClientOriginalExtension();
                $data['path_sptjm'] = $file_sptjm_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_sptjm->getClientOriginalName(),
                    'document_type' => 'sptjm',
                    'file_path' => $file_sptjm_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }

            if ($request->hasFile('file_dokumen_tambahan')) {
                $file_dokumen_tambahan = $request->file('file_dokumen_tambahan');
                $file_dokumen_tambahan_name = md5('dokumen_tambahan' . time()) . time() . '.' . $file_dokumen_tambahan->getClientOriginalExtension();
                $data['path_dokumen_tambahan'] = $file_dokumen_tambahan_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_dokumen_tambahan->getClientOriginalName(),
                    'document_type' => 'dokumen_tambahan',
                    'file_path' => $file_dokumen_tambahan_name,
                    'uploaded_at' => date('Y-m-d H:i:s'),
                ];
            }


            // status 0 = ditolak / revisi
            // status 1 = belum di approve
            // status 2 = sudah di approve disdukcapil


            $submission_document = SubmissionDocument::insert($documents);
            $trx = PerbaikanAktaDetail::create([
                'uid' => Str::uuid()->toString(),
                'submission_uid' => $submission->uid,
                'jenis_akta' => $data['jenis_akta'],
                'nomor_akta' => $data['no_akta'],
                'jenis_elemen_perbaikan' => $data['jenis_elemen_perbaikan'],
                'data_sebelum' => $data['data_sebelum'],
                'data_sesudah' => $data['data_sesudah'],
                'data_subject' => $data['subject'] ? json_encode($data['subject']) : "",
            ]);

            if ($trx) {
                if ($request->hasFile('file_penetapan_pengadilan')) {
                    $file_penetapan = $request->file('file_penetapan_pengadilan');
                    $file_penetapan->move(public_path('upload/file_penetapan_pengadilan'), $data['path_penetapan']);
                }

                if ($request->hasFile('file_akta_kelahiran')) {
                    $file_akta_kelahiran = $request->file('file_akta_kelahiran');
                    $file_akta_kelahiran->move(public_path('upload/file_akta_kelahiran'), $data['path_akta_kelahiran']);
                }

                if ($request->hasFile('file_kk_pemohon')) {
                    $file_kk_pemohon = $request->file('file_kk_pemohon');
                    $file_kk_pemohon->move(public_path('upload/file_kk_pemohon'), $data['path_kk_pemohon']);
                }

                if ($request->hasFile('file_ktp_pemohon')) {
                    $file_ktp_pemohon = $request->file('file_ktp_pemohon');
                    $file_ktp_pemohon->move(public_path('upload/file_ktp_pemohon'), $data['path_ktp_pemohon']);
                }

                if ($request->hasFile('file_keabsahan')) {
                    $file_keabsahan = $request->file('file_keabsahan');
                    $file_keabsahan->move(public_path('upload/file_keabsahan'), $data['path_keabsahan']);
                }

                if ($request->hasFile('file_akta_perkawinan')) {
                    $file_akta_perkawinan = $request->file('file_akta_perkawinan');
                    $file_akta_perkawinan->move(public_path('upload/file_akta_perkawinan'), $data['path_akta_perkawinan']);
                }

                if ($request->hasFile('file_akta_perceraian')) {
                    $file_akta_perceraian = $request->file('file_akta_perceraian');
                    $file_akta_perceraian->move(public_path('upload/file_akta_perceraian'), $data['path_akta_perceraian']);
                }

                if ($request->hasFile('file_keterangan_medis')) {
                    $file_keterangan_medis = $request->file('file_keterangan_medis');
                    $file_keterangan_medis->move(public_path('upload/file_keterangan_medis'), $data['path_keterangan_medis']);
                }

                if ($request->hasFile('file_ijazah')) {
                    $file_ijazah = $request->file('file_ijazah');
                    $file_ijazah->move(public_path('upload/file_ijazah'), $data['path_ijazah']);
                }

                if ($request->hasFile('file_keterangan_status_pekerjaan')) {
                    $file_keterangan_status_pekerjaan = $request->file('file_keterangan_status_pekerjaan');
                    $file_keterangan_status_pekerjaan->move(public_path('upload/file_keterangan_status_pekerjaan'), $data['path_keterangan_status_pekerjaan']);
                }

                if ($request->hasFile('file_paspor')) {
                    $file_paspor = $request->file('file_paspor');
                    $file_paspor->move(public_path('upload/file_paspor'), $data['path_paspor']);
                }

                if ($request->hasFile('file_sptjm')) {
                    $file_sptjm = $request->file('file_sptjm');
                    $file_sptjm->move(public_path('upload/file_sptjm'), $data['path_sptjm']);
                }

                if ($request->hasFile('file_dokumen_tambahan')) {
                    $file_dokumen_tambahan = $request->file('file_dokumen_tambahan');
                    $file_dokumen_tambahan->move(public_path('upload/file_dokumen_tambahan'), $data['path_dokumen_tambahan']);
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
                    $notif['jenis_perkara'] = "Perbaikan Akta";
                    $notif['nama_disdukcapil'] = $disdukcapil->nama;
                    $notif['alamat_disdukcapil'] = $disdukcapil->alamat;
                    $notif['no_telp_disdukcapil'] = $disdukcapil->no_telp;
                    $notif['tanggal_pengajuan'] = date('d-m-Y H:i:s');
                    Mail::to($disdukcapil->email)->send(new NotifEmail($notif));
                    $nama_disdukcapil = $disdukcapil->nama;
                    $nama_pemohon = $pemohon->name;
                    $nomor_perkara = $data['no_perkara'];
                    $tanggal_pengajuan = date('d-m-Y H:i:s');
                    $jenis_permohonan = "Perbaikan Akta";
                    $message = <<<EOT
                    Yth. $nama_disdukcapil,

                    Kami informasikan bahwa usulan pemohon terkait perkara perdata catatan sipil yang telah dikirimkan oleh Pengadilan Negeri Bale Bandung. Kami mohon agar Disdukcapil dapat segera menindaklanjuti usulan yang telah diajukan.

                    Informasi Terkait Usulan yang Dikirimkan:

                    📝 Nama Pemohon      : $nama_pemohon
                    📑 Nomor Perkara      : $nomor_perkara
                    📅 Tanggal Pengajuan : $tanggal_pengajuan
                    🗃 Jenis Permohonan  : $jenis_permohonan

                    Terima kasih atas kerjasamanya.
                    Pengadilan Negeri Bale Bandung
                    EOT;
                    WhatsappHelper::sendSingleMessage($disdukcapil->no_telp, $message);

                    if (str_contains(strtolower($disdukcapil->nama), 'cimahi')) {
                        // Lakukan sesuatu jika Disdukcapil adalah Kota Cimahi
                        $client = new GuzzleClient([
                            'http_errors' => false
                        ]);
                        $url = 'https://gsb.cimahikota.go.id/api/disdukcapil/pn_bale_bandung/perbaikan_data';
                        $senddata = [
                            'name' => $nomor_perkara,
                            'requirement' => [
                                'form' => [
                                    'province' => [
                                        'id' => $data['subject']['province'],
                                        'name' => DataHelper::getProvinceLabel($data['subject']['province']),
                                    ],
                                    'city' => [
                                        'id' => $data['subject']['regency'],
                                        'name' => DataHelper::getRegencyLabel($data['subject']['regency']),
                                    ],
                                    'district' => [
                                        'id' => $data['subject']['district'],
                                        'name' => DataHelper::getDistrictLabel($data['subject']['district']),
                                    ],
                                    'village' => [
                                        'id' => $data['subject']['village'],
                                        'name' => DataHelper::getVillageLabel($data['subject']['village']),
                                    ],
                                    'region_code' => '',
                                    'informant_name' => $pemohon->name,
                                    'informant_identity_number' => $pemohon->nik,
                                    'informant_family_number' => $pemohon->kk,
                                    'informant_citizenship' => '',
                                    'informant_travel_document_number' => $pemohon->nomor_paspor,
                                    'informant_gender' => strtolower($pemohon->jenis_kelamin) == "laki-laki" ? "1" : "2",
                                    'informant_occupation' => $pemohon->job,
                                    'informant_email' => $pemohon->email,
                                    'informant_phone' => $pemohon->no_telp,

                                    'birth_place' => $data['subject']['tempat_lahir'],
                                    'birth_date' => $data['subject']['tanggal_lahir'],
                                    'birth_certificate_number' => $data['subject']['akta_kelahiran'],
                                    'blood_type' => $data['subject']['blood_type'],
                                    'religion' => $data['subject']['religion'],
                                    'marriage_status' => $data['subject']['status_kawin'],
                                    'marriage_certificate_number' => $data['subject']['akta_kawin'],
                                    'marriage_date' => $data['subject']['tanggal_kawin'],
                                    'divorce_certificate_number' => $data['subject']['akta_cerai'],
                                    'divorce_date' => $data['subject']['tanggal_cerai'],
                                    'family_relationship_status' => $data['subject']['family_relationship'],
                                    'last_education' => $data['subject']['education'],
                                    'occupation' => $data['subject']['job'],
                                    'passport_number' => $data['subject']['nomor_paspor'],
                                    'passport_expired_date' => $data['subject']['tanggal_berlaku_paspor'],
                                    'data_identity_number' => $data['subject']['nik'],
                                    'data_name' => $data['subject']['name'],
                                    'father_name' => $data['subject']['nama_ayah'],
                                    'father_date_of_birth' => '',
                                    'father_place_of_birth' => '',
                                    'father_identity_number' => '',
                                    'father_citizenship' => '',
                                    'mother_name' => $data['subject']['nama_ibu'],
                                    'mother_date_of_birth' => '',
                                    'mother_place_of_birth' => '',
                                    'mother_identity_number' => '',
                                    'mother_citizenship' => '',
                                    'notes_citizenship' => '',
                                    'notes_officer' => $data['subject']['keterangan'],
                                ],
                                'attachment' => [
                                    'birth_certificate' => isset($data['path_akta_kelahiran']) ? asset("upload/file_akta_kelahiran/" . $data['path_akta_kelahiran']) : "",
                                    'mariage_certificate' => isset($data['path_akta_perkawinan']) ? asset("upload/file_akta_perkawinan/" . $data['path_akta_perkawinan']) : "",
                                    'divorce_certificate' => isset($data['path_akta_perceraian']) ? asset("upload/file_akta_perceraian/" . $data['path_akta_perceraian']) : "",
                                    'medical_information' => isset($data['path_keterangan_medis']) ? asset("upload/file_keterangan_medis/" . $data['path_keterangan_medis']) : "",
                                    'education_certificate' => isset($data['path_ijazah']) ? asset("upload/file_ijazah/" . $data['path_ijazah']) : "",
                                    'employment_status' => isset($data['path_keterangan_status_pekerjaan']) ? asset("upload/file_keterangan_status_pekerjaan/" . $data['path_keterangan_status_pekerjaan']) : "",
                                    'passport' => isset($data['path_paspor']) ? asset("upload/file_paspor/" . $data['path_paspor']) : "",
                                    'court_order_letter' => isset($data['path_penetapan']) ? asset("upload/file_penetapan_pengadilan/" . $data['path_penetapan']) : "",
                                    'sptjm' => isset($data['path_sptjm']) ? asset("upload/file_sptjm/" . $data['path_sptjm']) : "",
                                    'additional_document' => isset($data['path_dokumen_tambahan']) ? asset("upload/file_dokumen_tambahan/" . $data['path_dokumen_tambahan']) : "",
                                ],
                            ],
                        ];
                        $response = $client->request('POST', $url, [
                            'headers' => [
                                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkVrYSBDaGFuZHJhIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c',
                            ],
                            'json' => $senddata
                        ]);
                        $status = $response->getStatusCode();
                        $resCimahi = json_decode($response->getBody()->getContents());
                        $trx->response_cimahi = json_encode($resCimahi);
                        $trx->save();
                        // dd(json_encode($senddata));
                        // echo $response->getBody();
                    }
                }

                if ($pemohon) {
                    $notif = [];
                    $notif['logo'] = $disdukcapil->cdn_picture;
                    $notif['title'] = 'Notifikasi Perubahan Usulan';
                    $notif['nama'] = $pemohon->name;
                    $notif['nama_pemohon'] = $pemohon->name;
                    $notif['no_telp'] = $pemohon->no_telp;
                    $notif['no_perkara'] = $data['no_perkara'];
                    $notif['alamat'] = $pemohon->alamat;
                    $notif['alamat_pemohon'] = $pemohon->alamat;
                    $notif['email'] = $pemohon->email;
                    $notif['jenis_perkara'] = "Perbaikan Akta";
                    $notif['nama_disdukcapil'] = $disdukcapil->nama;
                    $notif['alamat_disdukcapil'] = $disdukcapil->alamat;
                    $notif['no_telp_disdukcapil'] = $disdukcapil->no_telp;
                    $notif['tanggal_pengajuan'] = date('d-m-Y H:i:s');
                    Mail::to($pemohon->email)->send(new NotifEmailCust($notif));
                    $nama_pemohon = $pemohon->name;
                    $alamat_pemohon = $pemohon->alamat;
                    $nomor_perkara = $data['no_perkara'];
                    $tanggal_pengajuan = date('d-m-Y H:i:s');
                    $jenis_permohonan = "Perbaikan Akta";
                    $message = <<<EOT
                        Yth. $nama_pemohon,
                        $alamat_pemohon

                        Pengajuan dokumen administrasi catatan sipil Anda telah berhasil dikirim melalui Pengadilan Negeri Bale Bandung dan saat ini menunggu proses verifikasi serta validasi dari Disdukcapil. Mohon tunggu notifikasi selanjutnya terkait hasil pengajuan Anda.

                        Informasi Pengajuan Anda:

                        📝 Nama Pemohon      : $nama_pemohon
                        📑 Nomor Perkara      : $nomor_perkara
                        📅 Tanggal Pengajuan : $tanggal_pengajuan
                        🗃 Jenis Permohonan  : $jenis_permohonan

                        Terima kasih atas kerjasamanya.
                        Pengadilan Negeri Bale Bandung
                        EOT;
                    WhatsappHelper::sendSingleMessage($pemohon->no_telp, $message);
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
    public function show(PerbaikanAktaDetail $perbaikanAktaDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uid)
    {
        if (!PermissionCommon::check('perbaikan_akta.update')) abort(403);
        $perbaikanAktaDetail = PerbaikanAktaDetail::find($uid);
        if ($perbaikanAktaDetail) {
            $uid = $perbaikanAktaDetail->uid;
            $data = $perbaikanAktaDetail;
            $pemohon = Pemohon::all();
            $disdukcapil = Disdukcapil::all();
            $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
            $body = view('pages.administrasi.usulan.perbaikan_akta.edit', compact('uid', 'data', 'pemohon', 'disdukcapil', 'provinces'))->render();
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
        if (!PermissionCommon::check('perbaikan_akta.update')) abort(403);
        $perbaikanAktaDetail = PerbaikanAktaDetail::find($uid);
        $request->validate([
            'no_perkara' => "required|unique:submissions,no_perkara," . $perbaikanAktaDetail->submission->uid . ",uid",
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',
            'jenis_akta' => 'required',
            'no_akta' => 'required',
            'jenis_elemen_perbaikan' => 'required',
            'data_sebelum' => 'required',
            'data_sesudah' => 'required',

            'file_penetapan_pengadilan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta_kelahiran' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk_pemohon' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_pemohon' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_keabsahan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',
            'jenis_akta.required' => 'Jenis Akta tidak boleh kosong',
            'no_akta.required' => 'Nomor Akta tidak boleh kosong',
            'jenis_elemen_perbaikan.required' => 'Jenis Elemen Perbaikan tidak boleh kosong',
            'data_sebelum.required' => 'Data Sebelum tidak boleh kosong',
            'data_sesudah.required' => 'Data Sesudah tidak boleh kosong',

            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_akta_kelahiran.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta_kelahiran.max' => 'Ukuran file akta kelahiran maksimal 2MB',

            'file_kk_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk_pemohon.max' => 'Ukuran file KK Pemohon maksimal 2MB',

            'file_ktp_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_pemohon.max' => 'Ukuran file KTP Pemohon maksimal 2MB',

            'file_keabsahan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_keabsahan.max' => 'Ukuran file keabsahan maksimal 2MB',
        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $documents = SubmissionDocument::where('submission_uid', $perbaikanAktaDetail->submission->uid)->get();
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
            $catatan = json_decode($perbaikanAktaDetail->submission->catatan);
            $catatan[] = [
                'role' => $role,
                'name' => $name,
                'status' => '4',
                'catatan' => $formData['catatan'],
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $perbaikanAktaDetail->submission->no_perkara = $formData['no_perkara'];
            $perbaikanAktaDetail->submission->pemohon_uid = $formData['pemohon_uid'];
            $perbaikanAktaDetail->submission->disdukcapil_uid = $formData['disdukcapil'];
            $perbaikanAktaDetail->submission->status = '1';
            $perbaikanAktaDetail->submission->catatan = json_encode($catatan);
            $perbaikanAktaDetail->submission->updated_by = auth()->user()->uid;
            $perbaikanAktaDetail->submission->save();

            $perbaikanAktaDetail->jenis_akta = $formData['jenis_akta'];
            $perbaikanAktaDetail->nomor_akta = $formData['no_akta'];
            $perbaikanAktaDetail->jenis_elemen_perbaikan = $formData['jenis_elemen_perbaikan'];
            $perbaikanAktaDetail->data_sebelum = $formData['data_sebelum'];
            $perbaikanAktaDetail->data_sesudah = $formData['data_sesudah'];

            $trx = $perbaikanAktaDetail->save();

            $disdukcapil = Disdukcapil::find($formData['disdukcapil']);
            $pemohon = Pemohon::find($formData['pemohon_uid']);
            if ($pemohon) {
                $notif = [];
                $notif['logo'] = $disdukcapil->cdn_picture;
                $notif['title'] = 'Notifikasi Perubahan Usulan';
                $notif['nama'] = $pemohon->name;
                $notif['nama_pemohon'] = $pemohon->name;
                $notif['no_telp'] = $pemohon->no_telp;
                $notif['no_perkara'] = $formData['no_perkara'];
                $notif['alamat'] = $pemohon->alamat;
                $notif['alamat_pemohon'] = $pemohon->alamat;
                $notif['email'] = $pemohon->email;
                $notif['jenis_perkara'] = "Perbaikan Akta";
                $notif['nama_disdukcapil'] = $disdukcapil->nama;
                $notif['alamat_disdukcapil'] = $disdukcapil->alamat;
                $notif['no_telp_disdukcapil'] = $disdukcapil->no_telp;
                $notif['tanggal_pengajuan'] = date('d-m-Y H:i:s');
                Mail::to($pemohon->email)->send(new NotifEmailCust($notif));
                $nama_pemohon = $pemohon->name;
                $alamat_pemohon = $pemohon->alamat;
                $nomor_perkara = $formData['no_perkara'];
                $tanggal_pengajuan = date('d-m-Y H:i:s');
                $jenis_permohonan = "Perbaikan Akta";
                $message = <<<EOT
                    Yth. $nama_pemohon,
                    $alamat_pemohon

                    Pengajuan dokumen administrasi catatan sipil Anda telah berhasil dikirim melalui Pengadilan Negeri Bale Bandung dan saat ini menunggu proses verifikasi serta validasi dari Disdukcapil. Mohon tunggu notifikasi selanjutnya terkait hasil pengajuan Anda.

                    Informasi Pengajuan Anda:

                    📝 Nama Pemohon      : $nama_pemohon
                    📑 Nomor Perkara      : $nomor_perkara
                    📅 Tanggal Pengajuan : $tanggal_pengajuan
                    🗃 Jenis Permohonan  : $jenis_permohonan

                    Terima kasih atas kerjasamanya.
                    Pengadilan Negeri Bale Bandung
                    EOT;
                WhatsappHelper::sendSingleMessage($pemohon->no_telp, $message);
            }

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
        if (!PermissionCommon::check('perbaikan_akta.delete')) abort(403);
        $perbaikanAktaDetail = PerbaikanAktaDetail::find($uid);
        if (!$perbaikanAktaDetail) {
            return response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        try {
            $documents = $perbaikanAktaDetail->submission->documents;
            foreach ($documents as $document) {
                // Delete the old profile image if it exists
                if ($document && file_exists(public_path("upload/file_$document->document_type/" . $document->file_path))) {
                    unlink(public_path("upload/file_$document->document_type/" . $document->file_path));
                }
            }
            $perbaikanAktaDetail->delete();
            $perbaikanAktaDetail->submission->documents()->delete();
            $perbaikanAktaDetail->submission->delete();
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
            $perbaikanAktaDetail = PerbaikanAktaDetail::find($uid);
            if ($perbaikanAktaDetail) {
                $catatan = json_decode($perbaikanAktaDetail->submission->catatan);
                $body = view('pages.administrasi.usulan.perbaikan_akta.catatan', compact('perbaikanAktaDetail', 'catatan'))->render();
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
