<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionCommon;
use App\Models\Submission;
use Illuminate\Http\Request;

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
                if ($trx) {
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
                if ($trx) {
                    $createdBy = $usulan->createdBy();

                    // prosedur kirim WA

                    // try {
                    //     $options = [
                    //         'multipart' => [
                    //             [
                    //                 'name' => 'device_id',
                    //                 'contents' => '93ce715666c4811b544060462e10db8f'
                    //             ],
                    //             [
                    //                 'name' => 'number',
                    //                 'contents' => $createdBy->no_telp,
                    //             ],
                    //             [
                    //                 'name' => 'message',
                    //                 'contents' => 'Yang terhormat Bapak/Ibu *' . $createdBy->operator . '*, Mohon maaf usulan dengan nomor perkara *' . $usulan->no_perkara . '* dari pemohon *' . $usulan->pemohon->name . '* kami tolak karena beberapa pertimbangan.'
                    //             ]
                    //         ]
                    //     ];
                    //     $client = new GuzzleClient([
                    //         'http_errors' => false
                    //     ]);
                    //     $res1 = $client->postAsync('https://app.whacenter.com/api/send', $options)->wait();

                    //     $options2 = [
                    //         'multipart' => [
                    //             [
                    //                 'name' => 'device_id',
                    //                 'contents' => '93ce715666c4811b544060462e10db8f'
                    //             ],
                    //             [
                    //                 'name' => 'number',
                    //                 'contents' => $usulan->pemohon->no_telp,
                    //             ],
                    //             [
                    //                 'name' => 'message',
                    //                 'contents' => 'Yang terhormat Bapak/Ibu *' . $usulan->pemohon->name . '*, Mohon maaf usulan dengan nomor perkara *' . $usulan->no_perkara . '* dengan jenis perkara *' . $usulan->jenis_perkara . '* kami tolak karena beberapa pertimbangan.'
                    //             ]
                    //         ]
                    //     ];
                    //     $res2 = $client->postAsync('https://app.whacenter.com/api/send', $options2)->wait();
                    // } catch (\Throwable $th) {
                    //     //throw $th;
                    // }
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
