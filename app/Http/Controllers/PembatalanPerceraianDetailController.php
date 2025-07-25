<?php

namespace App\Http\Controllers;

use App\DataTables\PembatalanPerceraianDetailDataTable;
use App\Helpers\PermissionCommon;
use App\Helpers\WhatsappHelper;
use App\Mail\NotifEmail;
use App\Models\Disdukcapil;
use App\Models\PembatalanPerceraianDetail;
use App\Models\Pemohon;
use App\Models\Submission;
use App\Models\SubmissionDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PembatalanPerceraianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PembatalanPerceraianDetailDataTable $dataTable)
    {
        if (!PermissionCommon::check('pembatalan_perceraian.list')) abort(403);
        return $dataTable->render('pages.administrasi.usulan.pembatalan_perceraian.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('pembatalan_perceraian.create')) abort(403);
        $pemohon = Pemohon::all();
        $disdukcapil = Disdukcapil::all();
        $body = view('pages.administrasi.usulan.pembatalan_perceraian.create', compact('pemohon', 'disdukcapil'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Tambah Usulan Pembatalan Perceraian',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!PermissionCommon::check('pembatalan_perceraian.create')) abort(403);
        $request->validate([
            'no_perkara' => 'required|unique:submissions,no_perkara',
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nama_suami' => 'required',
            'nama_istri' => 'required',

            'file_penetapan_pengadilan' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta_perceraian' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_pemohon' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',

            'nama_suami.required' => 'Nama Suami tidak boleh kosong',
            'nama_istri.required' => 'Nama Istri tidak boleh kosong',

            'file_penetapan_pengadilan.required' => 'File Penetapan Pengadilan tidak boleh kosong',
            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_akta_perceraian.required' => 'File Akta Perceraian tidak boleh kosong',
            'file_akta_perceraian.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta_perceraian.max' => 'Ukuran file akta perceraian maksimal 2MB',

            'file_kk.required' => 'File KK Orang Tua Angkat tidak boleh kosong',
            'file_kk.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk.max' => 'Ukuran file KK Orang Tua Angkat maksimal 2MB',

            'file_ktp_pemohon.required' => 'File KTP Pemohon tidak boleh kosong',
            'file_ktp_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_pemohon.max' => 'Ukuran file KTP Pemohon maksimal 2MB',

        ]);

        $data = $request->except('_token');
        try {
            $submission = Submission::create([
                'uid' => Str::uuid()->toString(),
                'no_perkara' => $data['no_perkara'],
                'submission_type' => 'pembatalan_perceraian',
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

            if ($request->hasFile('file_kk')) {
                $file_kk = $request->file('file_kk');
                $file_kk_name = md5('kk' . time()) . time() . '.' . $file_kk->getClientOriginalExtension();
                $data['path_kk'] = $file_kk_name;
                $documents[] = [
                    'uid' => Str::uuid()->toString(),
                    'submission_uid' => $submission->uid,
                    'document_name' => $file_kk->getClientOriginalName(),
                    'document_type' => 'kk',
                    'file_path' => $file_kk_name,
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




            // status 0 = ditolak / revisi
            // status 1 = belum di approve
            // status 2 = sudah di approve disdukcapil

            $submission_document = SubmissionDocument::insert($documents);
            $trx = PembatalanPerceraianDetail::create([
                'uid' => Str::uuid()->toString(),
                'submission_uid' => $submission->uid,
                'nama_suami' => $data['nama_suami'],
                'nama_istri' => $data['nama_istri'],
            ]);

            if ($trx) {
                if ($request->hasFile('file_penetapan_pengadilan')) {
                    $file_penetapan = $request->file('file_penetapan_pengadilan');
                    $file_penetapan->move(public_path('upload/file_penetapan_pengadilan'), $data['path_penetapan']);
                }

                if ($request->hasFile('file_akta_perceraian')) {
                    $file_akta_perceraian = $request->file('file_akta_perceraian');
                    $file_akta_perceraian->move(public_path('upload/file_akta_perceraian'), $data['path_akta_perceraian']);
                }

                if ($request->hasFile('file_kk')) {
                    $file_kk = $request->file('file_kk');
                    $file_kk->move(public_path('upload/file_kk'), $data['path_kk']);
                }

                if ($request->hasFile('file_ktp_pemohon')) {
                    $file_ktp_pemohon = $request->file('file_ktp_pemohon');
                    $file_ktp_pemohon->move(public_path('upload/file_ktp_pemohon'), $data['path_ktp_pemohon']);
                }

                if ($request->hasFile('keabsahan_akta_kelahiran')) {
                    $file_keabsahan = $request->file('keabsahan_akta_kelahiran');
                    $file_keabsahan->move(public_path('upload/keabsahan_akta_kelahiran'), $data['path_keabsahan_akta_kelahiran']);
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
                    $notif['jenis_perkara'] = "Pembatalan Akta Perceraian";
                    $notif['nama_disdukcapil'] = $disdukcapil->nama;
                    $notif['alamat_disdukcapil'] = $disdukcapil->alamat;
                    $notif['no_telp_disdukcapil'] = $disdukcapil->no_telp;
                    $notif['tanggal_pengajuan'] = date('d-m-Y H:i:s');
                    Mail::to($disdukcapil->email)->send(new NotifEmail($notif));
                    $nama_disdukcapil = $disdukcapil->nama;
                    $nama_pemohon = $pemohon->name;
                    $nomor_perkara = $data['no_perkara'];
                    $tanggal_pengajuan = date('d-m-Y H:i:s');
                    $jenis_permohonan = "Pembatalan Akta Perceraian";
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
    public function show(PembatalanPerceraianDetail $pembatalanPerceraianDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uid)
    {
        if (!PermissionCommon::check('pembatalan_perceraian.update')) abort(403);
        $pembatalanPerceraianDetail = PembatalanPerceraianDetail::find($uid);
        if ($pembatalanPerceraianDetail) {
            $uid = $pembatalanPerceraianDetail->uid;
            $data = $pembatalanPerceraianDetail;
            $pemohon = Pemohon::all();
            $disdukcapil = Disdukcapil::all();
            $body = view('pages.administrasi.usulan.pembatalan_perceraian.edit', compact('uid', 'data', 'pemohon', 'disdukcapil'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Usulan Pembatalan Perceraian',
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
        if (!PermissionCommon::check('pembatalan_perceraian.update')) abort(403);
        $pembatalanPerceraianDetail = PembatalanPerceraianDetail::find($uid);
        $request->validate([
            'no_perkara' => "required|unique:submissions,no_perkara," . $pembatalanPerceraianDetail->submission->uid . ",uid",
            'pemohon_uid' => 'required',
            'disdukcapil' => 'required',

            'nama_suami' => 'required',
            'nama_istri' => 'required',

            'file_penetapan_pengadilan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta_perceraian' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_ktp_pemohon' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'disdukcapil.required' => 'Kantor Disdukcapil tidak boleh kosong',

            'nama_suami.required' => 'Nama Suami tidak boleh kosong',
            'nama_istri.required' => 'Nama Istri tidak boleh kosong',

            'file_penetapan_pengadilan.required' => 'File Penetapan Pengadilan tidak boleh kosong',
            'file_penetapan_pengadilan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan_pengadilan.max' => 'Ukuran file penetapan pengadilan maksimal 2MB',

            'file_akta_perceraian.required' => 'File Akta Perceraian tidak boleh kosong',
            'file_akta_perceraian.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta_perceraian.max' => 'Ukuran file akta perceraian maksimal 2MB',

            'file_kk.required' => 'File KK Orang Tua Angkat tidak boleh kosong',
            'file_kk.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk.max' => 'Ukuran file KK Orang Tua Angkat maksimal 2MB',

            'file_ktp_pemohon.required' => 'File KTP Pemohon tidak boleh kosong',
            'file_ktp_pemohon.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp_pemohon.max' => 'Ukuran file KTP Pemohon maksimal 2MB',

        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $documents = SubmissionDocument::where('submission_uid', $pembatalanPerceraianDetail->submission->uid)->get();
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
            $catatan = json_decode($pembatalanPerceraianDetail->submission->catatan);
            $catatan[] = [
                'role' => $role,
                'name' => $name,
                'status' => '4',
                'catatan' => $formData['catatan'],
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $pembatalanPerceraianDetail->submission->no_perkara = $formData['no_perkara'];
            $pembatalanPerceraianDetail->submission->pemohon_uid = $formData['pemohon_uid'];
            $pembatalanPerceraianDetail->submission->disdukcapil_uid = $formData['disdukcapil'];
            $pembatalanPerceraianDetail->submission->status = '1';
            $pembatalanPerceraianDetail->submission->catatan = json_encode($catatan);
            $pembatalanPerceraianDetail->submission->updated_by = auth()->user()->uid;
            $pembatalanPerceraianDetail->submission->save();


            $pembatalanPerceraianDetail->nama_suami = $formData['nama_suami'];
            $pembatalanPerceraianDetail->nama_istri = $formData['nama_istri'];

            $trx = $pembatalanPerceraianDetail->save();

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
        if (!PermissionCommon::check('pembatalan_perceraian.delete')) abort(403);
        $pembatalanPerceraianDetail = PembatalanPerceraianDetail::find($uid);
        if (!$pembatalanPerceraianDetail) {
            return response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        try {
            $documents = $pembatalanPerceraianDetail->submission->documents;
            foreach ($documents as $document) {
                // Delete the old profile image if it exists
                if ($document && file_exists(public_path("upload/file_$document->document_type/" . $document->file_path))) {
                    unlink(public_path("upload/file_$document->document_type/" . $document->file_path));
                }
            }
            $pembatalanPerceraianDetail->delete();
            $pembatalanPerceraianDetail->submission->documents()->delete();
            $pembatalanPerceraianDetail->submission->delete();
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
            $pembatalanPerceraianDetail = PembatalanPerceraianDetail::find($uid);
            if ($pembatalanPerceraianDetail) {
                $catatan = json_decode($pembatalanPerceraianDetail->submission->catatan);
                $body = view('pages.administrasi.usulan.pembatalan_perceraian.catatan', compact('pembatalanPerceraianDetail', 'catatan'))->render();
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
