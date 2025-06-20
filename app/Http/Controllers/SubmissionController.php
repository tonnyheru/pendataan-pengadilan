<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionCommon;
use App\Helpers\WhatsappHelper;
use App\Mail\ApprovalEmail;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubmissionController extends Controller
{
    public function approvement($uid, $detail)
    {
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);
        $submission = Submission::find($uid);
        switch ($detail) {
            case 'perbaikan_akta':
                $detail = $submission->perbaikanAktaDetail;
                $body = view('pages.administrasi.usulan.perbaikan_akta.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'akta_kematian':
                $detail = $submission->aktaKematianDetail;
                $body = view('pages.administrasi.usulan.akta_kematian.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Penerbitan Akta Kematian',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'akta_perkawinan':
                $detail = $submission->aktaPerkawinanDetail;
                $body = view('pages.administrasi.usulan.akta_perkawinan.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Penerbitan Akta Perkawinan',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'akta_perceraian':
                $detail = $submission->aktaPerceraianDetail;
                $body = view('pages.administrasi.usulan.akta_perceraian.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Penerbitan Akta Perceraian',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pengangkatan_anak':
                $detail = $submission->pengangkatanAnakDetail;
                $body = view('pages.administrasi.usulan.pengangkatan_anak.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Pengangkatan Anak',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pengakuan_anak':
                $detail = $submission->pengakuanAnakDetail;
                $body = view('pages.administrasi.usulan.pengakuan_anak.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Pengakuan Anak',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pembatalan_akta_kelahiran':
                $detail = $submission->pembatalanAktaKelahiranDetail;
                $body = view('pages.administrasi.usulan.pembatalan_akta_kelahiran.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Pembatalan Akta Kelahiran',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pembatalan_perceraian':
                $detail = $submission->pembatalanPerceraianDetail;
                $body = view('pages.administrasi.usulan.pembatalan_perceraian.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Pembatalan Perceraian',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pembatalan_perkawinan':
                $detail = $submission->pembatalanPerkawinanDetail;
                $body = view('pages.administrasi.usulan.pembatalan_perkawinan.form_approve', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
                return [
                    'title' => 'Approve Usulan Pembatalan Perkawinan',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            default:
                return [];
        }
    }

    public function approvement_store(Request $request, $uid)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $request->validate([
                'catatan' => 'required',
            ], [
                'catatan.required' => 'Catatan tidak boleh kosong',
            ]);

            $usulan = Submission::find($uid);
            $formData = $request->except('_token', '_method');
            if ($usulan) {
                $name = auth()->user()->name;
                $role = auth()->user()->role->name;
                $slug = auth()->user()->role->slug;

                $formData['status'] = '2';
                // if (str_contains($slug, 'disdukcapil')) {
                //     $formData['is_approve'] = '2';
                // } else {
                //     $formData['is_approve'] = '1';
                // }

                $catatan = json_decode($usulan->catatan);
                $catatan[] = [
                    'role' => $role,
                    'name' => $name,
                    'status' => $formData['status'],
                    'catatan' => $formData['catatan'],
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                $formData['catatan'] = json_encode($catatan);
                $formData['approved_by'] = auth()->user()->uid;
                $formData['approved_at'] = date('Y-m-d H:i:s');


                $trx = $usulan->update($formData);
                $detail = $usulan->submission_type;
                $jenis = '';
                switch ($detail) {
                    case 'perbaikan_akta':
                        $jenis = 'Perbaikan Akta';
                        break;
                    case 'akta_kematian':
                        $jenis = 'Penerbitan Akta Kematian';
                        break;
                    case 'akta_perkawinan':
                        $jenis = 'PenerbitanAkta Perkawinan';
                        break;
                    case 'akta_perceraian':
                        $jenis = 'Penerbitan Akta Perceraian';
                        break;
                    case 'pengangkatan_anak':
                        $jenis = 'Pengangkatan Anak';
                        break;
                    case 'pengakuan_anak':
                        $jenis = 'Pengesahan / Pengakuan Anak';
                        break;
                    case 'pembatalan_akta_kelahiran':
                        $jenis = 'Pembatalan Akta Kelahiran';
                        break;
                    case 'pembatalan_perceraian':
                        $jenis = 'Pembatalan Akta Perceraian';
                        break;
                    case 'pembatalan_perkawinan':
                        $jenis = 'Pembatalan Akta Perkawinan';
                        break;
                    default:
                        $jenis = 'Tidak Diketahui';
                        break;
                }
                if ($trx) {
                    $notif = [];
                    $notif['logo'] = $usulan->disdukcapil->cdn_picture;
                    $notif['approval'] = "approve";
                    $notif['daerah_disdukcapil'] = strtoupper(str_replace("disdukcapil","",strtolower($usulan->disdukcapil->nama)));
                    $notif['alamat_disdukcapil'] = $usulan->disdukcapil->alamat;
                    $nama_disdukcapil = $usulan->disdukcapil->nama;
                    switch($nama_disdukcapil) {
                        case 'Disdukcapil Kabupaten Bandung Barat':
                            $notif['telepon'] = '';
                            $notif['website'] = 'Website : <a href="http://bandungbaratkab.go.id/">http://bandungbaratkab.go.id/</a>';
                            $notif['email'] = 'Email : <a href="mailto:disdukcapil@bandungbaratkab.go.id">disdukcapil@bandungbaratkab.go.id</a>';
                            break;
                        case 'Disdukcapil Kabupaten Bandung':
                            $notif['telepon'] = 'Telp. (022) 5892126';
                            $notif['website'] = '';
                            $notif['email'] = '';
                            break;
                        case 'Disdukcapil Kota Cimahi':
                            $notif['telepon'] = 'Telepon : (022) 1234567';
                            $notif['website'] = 'Website : <a href="https://disdukcapil.cimahikota.go.id">https://disdukcapil.cimahikota.go.id</a>';
                            $notif['email'] = 'Email : <a href="mailto:disdukcapil@cimahikota.go.id">disdukcapil@cimahikota.go.id</a>';
                            break;
                        default:
                            $notif['telepon'] = '';
                            $notif['website'] = '';
                            $notif['email'] = '';
                    }
                    $notif['nama'] = $usulan->pemohon->name;
                    $notif['no_perkara'] = $usulan->no_perkara;
                    $notif['jenis_perkara'] = $jenis;
                    $notif['tanggal_pengajuan'] = date("d-m-Y H:i:s", strtotime($usulan->created_at));
                    // kirim ke pengadilan
                    $email_pengadilan = env('EMAIL_PENGADILAN');
                    Mail::to($email_pengadilan)->send(new ApprovalEmail($notif));
                    $disdukcapil = $usulan->disdukcapil->nama;
                    $nama_pemohon = $usulan->pemohon->name;
                    $nomor_perkara = $usulan->no_perkara;
                    $tanggal_pengajuan = date("d-m-Y H:i:s", strtotime($usulan->created_at));
                    $message = <<<EOT
                    Yth. Pengadilan Negeri Bale Bandung,

                    Kami informasikan bahwa usulan pemohon terkait perkara perdata catatan sipil yang diajukan oleh Pengadilan Negeri Bale Bandung *telah diterima dan disetujui* oleh pihak Disdukcapil. Proses pembaharuan dokumen catatan sipil untuk pemohon akan segera diproses sesuai dengan prosedur yang berlaku.

                    Informasi Terkait Usulan yang Dikirimkan:

                    📝 Nama Pemohon      : $nama_pemohon
                    📑 Nomor Perkara     : $nomor_perkara
                    📅 Tanggal Pengajuan : $tanggal_pengajuan
                    🗃 Jenis Permohonan  : $jenis

                    Terima kasih atas kerjasamanya.
                    $disdukcapil
                    EOT;
                    //ieu whatsapp pengadilan
                    $nomor_pengadilan = env('NOMOR_PENGADILAN');
                    WhatsappHelper::sendSingleMessage($nomor_pengadilan, $message);
                    return response([
                        'status' => true,
                        'message' => 'Data Berhasil Disetujui'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Data Gagal Disetujui'
                    ], 400);
                }
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

    public function rejectment($uid, $detail)
    {
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);
        $submission = Submission::find($uid);
        switch ($detail) {
            case 'perbaikan_akta':
                $detail = $submission->perbaikanAktaDetail;
                $body = view('pages.administrasi.usulan.perbaikan_akta.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Perbaikan Akta',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'akta_kematian':
                $detail = $submission->aktaKematianDetail;
                $body = view('pages.administrasi.usulan.akta_kematian.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Penerbitan Akta Kematian',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'akta_perkawinan':
                $detail = $submission->aktaPerkawinanDetail;
                $body = view('pages.administrasi.usulan.akta_perkawinan.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Penerbitan Akta Perkawinan',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'akta_perceraian':
                $detail = $submission->aktaPerceraianDetail;
                $body = view('pages.administrasi.usulan.akta_perceraian.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Penerbitan Akta Perceraian',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pengangkatan_anak':
                $detail = $submission->pengangkatanAnakDetail;
                $body = view('pages.administrasi.usulan.pengangkatan_anak.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Pengangkatan Anak',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pengakuan_anak':
                $detail = $submission->pengakuanAnakDetail;
                $body = view('pages.administrasi.usulan.pengakuan_anak.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Pengakuan Anak',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pembatalan_akta_kelahiran':
                $detail = $submission->pembatalanAktaKelahiranDetail;
                $body = view('pages.administrasi.usulan.pembatalan_akta_kelahiran.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Pembatalan Akta Kelahiran',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pembatalan_perceraian':
                $detail = $submission->pembatalanPerceraianDetail;
                $body = view('pages.administrasi.usulan.pembatalan_perceraian.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Pembatalan Perceraian',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            case 'pembatalan_perkawinan':
                $detail = $submission->pembatalanPerkawinanDetail;
                $body = view('pages.administrasi.usulan.pembatalan_perkawinan.form_reject', compact('submission', 'uid', 'detail'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'reject\')">Reject</button>';
                return [
                    'title' => 'Reject Usulan Pembatalan Perkawinan',
                    'body' => $body,
                    'footer' => $footer
                ];
                break;
            default:
                return [];
        }
    }

    public function rejectment_store(Request $request, $uid)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $request->validate([
                'catatan' => 'required',
            ], [
                'catatan.required' => 'Catatan tidak boleh kosong',
            ]);

            $usulan = Submission::find($uid);
            $formData = $request->except('_token', '_method');
            if ($usulan) {
                $role = auth()->user()->role->name;
                $name = auth()->user()->name;
                $slug = auth()->user()->role->slug;

                $formData['status'] = '0';
                $catatan = json_decode($usulan->catatan);
                $catatan[] = [
                    'role' => $role,
                    'name' => $name,
                    'status' => $formData['status'],
                    'catatan' => $formData['catatan'],
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                $formData['catatan'] = json_encode($catatan);
                $formData['approved_by'] = auth()->user()->uid;
                $formData['approved_at'] = date('Y-m-d H:i:s');


                $trx = $usulan->update($formData);
                $detail = $usulan->submission_type;
                $jenis = '';
                switch ($detail) {
                    case 'perbaikan_akta':
                        $jenis = 'Perbaikan Akta';
                        break;
                    case 'akta_kematian':
                        $jenis = 'Penerbitan Akta Kematian';
                        break;
                    case 'akta_perkawinan':
                        $jenis = 'PenerbitanAkta Perkawinan';
                        break;
                    case 'akta_perceraian':
                        $jenis = 'Penerbitan Akta Perceraian';
                        break;
                    case 'pengangkatan_anak':
                        $jenis = 'Pengangkatan Anak';
                        break;
                    case 'pengakuan_anak':
                        $jenis = 'Pengesahan / Pengakuan Anak';
                        break;
                    case 'pembatalan_akta_kelahiran':
                        $jenis = 'Pembatalan Akta Kelahiran';
                        break;
                    case 'pembatalan_perceraian':
                        $jenis = 'Pembatalan Akta Perceraian';
                        break;
                    case 'pembatalan_perkawinan':
                        $jenis = 'Pembatalan Akta Perkawinan';
                        break;
                    default:
                        $jenis = 'Tidak Diketahui';
                        break;
                }
                if ($trx) {
                    $notif = [];
                    $notif['logo'] = $usulan->disdukcapil->cdn_picture;
                    $notif['approval'] = "reject";
                    $notif['daerah_disdukcapil'] = strtoupper(str_replace("disdukcapil","",strtolower($usulan->disdukcapil->nama)));
                    $notif['alamat_disdukcapil'] = $usulan->disdukcapil->alamat;
                    $nama_disdukcapil = $usulan->disdukcapil->nama;
                    switch($nama_disdukcapil) {
                        case 'Disdukcapil Kabupaten Bandung Barat':
                            $notif['alamat-line2'] = 'E-mail : <a href="mailto:disdukcapil@bandungbaratkab.go.id">disdukcapil@bandungbaratkab.go.id</a>  Web : <a href="http://bandungbaratkab.go.id">http://bandungbaratkab.go.id</a>';
                            break;
                        case 'Disdukcapil Kabupaten Bandung':
                            $notif['alamat-line2'] = 'Telp. (022) 5892126';
                            break;
                        case 'Disdukcapil Kota Cimahi':
                            $notif['alamat-line2'] = 'Telepon: (022) 6631885 | Website: <a href="https://disdukcapil.cimahikota.go.id">https://disdukcapil.cimahikota.go.id</a> | Email: <a href="mailto:disdukcapil@cimahikota.go.id">disdukcapil@cimahikota.go.id</a>';
                            break;
                        default:
                            $notif['alamat-line2'] = '';
                    }
                    $notif['nama'] = $usulan->pemohon->name;
                    $notif['no_perkara'] = $usulan->no_perkara;
                    $notif['jenis_perkara'] = $jenis;
                    $notif['tanggal_pengajuan'] = date("d-m-Y H:i:s", strtotime($usulan->created_at));
                    // kirim ke pengadilan
                    $email_pengadilan = env('EMAIL_PENGADILAN');
                    Mail::to($email_pengadilan)->send(new ApprovalEmail($notif));
                    $disdukcapil = $usulan->disdukcapil->nama;
                    $nama_pemohon = $usulan->pemohon->name;
                    $nomor_perkara = $usulan->no_perkara;
                    $tanggal_pengajuan = date("d-m-Y H:i:s", strtotime($usulan->created_at));
                    $message = <<<EOT
                    Yth. Pengadilan Negeri Bale Bandung,

                    Kami informasikan bahwa usulan pemohon terkait perkara perdata catatan sipil yang diajukan oleh Pengadilan Negeri Bale Bandung *ditolak* oleh pihak Disdukcapil. Mohon agar dapat melakukan verifikasi lebih lanjut dan mengajukan kembali permohonan yang sesuai dengan prosedur yang berlaku.

                    Informasi Terkait Usulan yang Dikirimkan:

                    📝 Nama Pemohon      : $nama_pemohon
                    📑 Nomor Perkara     : $nomor_perkara
                    📅 Tanggal Pengajuan : $tanggal_pengajuan
                    🗃 Jenis Permohonan  : $jenis

                    Terima kasih atas kerjasamanya.
                    $disdukcapil
                    EOT;
                    $nomor_pengadilan = env('NOMOR_PENGADILAN');
                    WhatsappHelper::sendSingleMessage($nomor_pengadilan, $message);
                    return response([
                        'status' => true,
                        'message' => 'Data Berhasil Ditolak'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Data Gagal Ditolak'
                    ], 400);
                }
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

    public function send_mail($uid)
    {
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);

        $submission = Submission::find($uid);
        if ($submission) {
            $body = view('pages.administrasi.usulan.form_email', compact('submission', 'uid'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="processMail()">Kirim Email <i class="fas fa-paper-plane"></i></button>';
            return [
                'title' => 'Kirim Email',
                'body' => $body,
                'footer' => $footer
            ];
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submission $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        //
    }
}
