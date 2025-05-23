<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionCommon;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function approvement($uid)
    {
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);

        $usulan = Submission::find($uid);
        if ($usulan) {
            $body = view('pages.administrasi.usulan.form_approve', compact('usulan', 'uid'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="approve_reject_store(\'approve\')">Approve</button>';
            return [
                'title' => 'Approve Usulan',
                'body' => $body,
                'footer' => $footer
            ];
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

            $usulan = Usulan::find($uid);
            $formData = $request->except('_token', '_method');
            if ($usulan) {
                $name = auth()->user()->name;
                $role = auth()->user()->role->name;
                $slug = auth()->user()->role->slug;

                if (str_contains($slug, 'disdukcapil')) {
                    $formData['is_approve'] = '2';
                } else {
                    $formData['is_approve'] = '1';
                }

                $catatan = json_decode($usulan->catatan);
                $catatan[] = [
                    'role' => $role,
                    'name' => $name,
                    'status' => $formData['is_approve'],
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

    public function rejectment($uid)
    {
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);

        $usulan = Submission::find($uid);
        if ($usulan) {
            $body = view('pages.administrasi.usulan.form_reject', compact('usulan', 'uid'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="approve_reject_store(\'reject\')">Reject</button>';
            return [
                'title' => 'Reject Usulan',
                'body' => $body,
                'footer' => $footer
            ];
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

            $usulan = Usulan::find($uid);
            $formData = $request->except('_token', '_method');
            if ($usulan) {
                $role = auth()->user()->role->name;
                $name = auth()->user()->name;
                $slug = auth()->user()->role->slug;

                $formData['is_approve'] = '0';
                $catatan = json_decode($usulan->catatan);
                $catatan[] = [
                    'role' => $role,
                    'name' => $name,
                    'status' => $formData['is_approve'],
                    'catatan' => $formData['catatan'],
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                $formData['catatan'] = json_encode($catatan);
                $formData['approved_by'] = auth()->user()->uid;
                $formData['approved_at'] = date('Y-m-d H:i:s');


                $trx = $usulan->update($formData);
                if ($trx) {
                    $createdBy = $usulan->createdBy();
                    try {
                        $options = [
                            'multipart' => [
                                [
                                    'name' => 'device_id',
                                    'contents' => '93ce715666c4811b544060462e10db8f'
                                ],
                                [
                                    'name' => 'number',
                                    'contents' => $createdBy->no_telp,
                                ],
                                [
                                    'name' => 'message',
                                    'contents' => 'Yang terhormat Bapak/Ibu *' . $createdBy->operator . '*, Mohon maaf usulan dengan nomor perkara *' . $usulan->no_perkara . '* dari pemohon *' . $usulan->pemohon->name . '* kami tolak karena beberapa pertimbangan.'
                                ]
                            ]
                        ];
                        $client = new GuzzleClient([
                            'http_errors' => false
                        ]);
                        $res1 = $client->postAsync('https://app.whacenter.com/api/send', $options)->wait();

                        $options2 = [
                            'multipart' => [
                                [
                                    'name' => 'device_id',
                                    'contents' => '93ce715666c4811b544060462e10db8f'
                                ],
                                [
                                    'name' => 'number',
                                    'contents' => $usulan->pemohon->no_telp,
                                ],
                                [
                                    'name' => 'message',
                                    'contents' => 'Yang terhormat Bapak/Ibu *' . $usulan->pemohon->name . '*, Mohon maaf usulan dengan nomor perkara *' . $usulan->no_perkara . '* dengan jenis perkara *' . $usulan->jenis_perkara . '* kami tolak karena beberapa pertimbangan.'
                                ]
                            ]
                        ];
                        $res2 = $client->postAsync('https://app.whacenter.com/api/send', $options2)->wait();
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
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
