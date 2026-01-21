<?php

namespace App\Http\Controllers;

use App\DataTables\UsulanDataTable;
use App\Helpers\PermissionCommon;
use App\Helpers\WhatsappHelper;
use App\Http\Resources\PostResource;
use App\Mail\ApprovalEmail;
use App\Mail\NotifEmail;
use App\Models\Disdukcapil;
use App\Models\Pemohon;
use App\Models\Submission;
use App\Models\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsulanDataTable $dataTable)
    {
        if (!PermissionCommon::check('usulan.list')) abort(403);
        // return $dataTable->render('pages.administrasi.usulan.list');
        return view('pages.administrasi.usulan.menu');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('usulan.create')) abort(403);
        $pemohon = Pemohon::all();
        $disdukcapil = Disdukcapil::all();
        $body = view('pages.administrasi.usulan.create', compact('pemohon', 'disdukcapil'))->render();
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
        if (!PermissionCommon::check('usulan.create')) abort(403);
        $request->validate([
            'no_perkara' => 'required|unique:usulan,no_perkara',
            'jenis_perkara' => 'required',
            'pemohon_uid' => 'required',
            'delegasi' => 'required',
            'file_ktp' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_penetapan' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pendukung' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_nikah' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pengantar' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'jenis_perkara.required' => 'Jenis Perkara tidak boleh kosong',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'delegasi.required' => 'Kantor Disdukcapil tidak boleh kosong',
            'file_ktp.required' => 'File KTP tidak boleh kosong',
            'file_ktp.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp.max' => 'Ukuran file ktp maksimal 2MB',
            'file_kk.required' => 'File KK tidak boleh kosong',
            'file_kk.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk.max' => 'Ukuran file kk maksimal 2MB',
            'file_akta.required' => 'File Akta tidak boleh kosong',
            'file_akta.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta.max' => 'Ukuran file akta maksimal 2MB',
            'file_penetapan.required' => 'File Penetapan tidak boleh kosong',
            'file_penetapan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan.max' => 'Ukuran file penetapan maksimal 2MB',
            'file_pendukung.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pendukung.max' => 'Ukuran file pendukung maksimal 2MB',
            'file_nikah.required' => 'Surat Nikah tidak boleh kosong',
            'file_nikah.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_nikah.max' => 'Ukuran surat nikah maksimal 2MB',
            'file_pengantar.required' => 'Surat Pengantar tidak boleh kosong',
            'file_pengantar.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pengantar.max' => 'Ukuran surat pengantar maksimal 2MB',
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

            if ($request->hasFile('file_penetapan')) {
                $file_penetapan = $request->file('file_penetapan');
                $file_penetapan_name = md5('ktp' . time()) . time() . '_' . $file_penetapan->getClientOriginalName();
                $data['path_penetapan'] = $file_penetapan_name;
            }

            if ($request->hasFile('file_nikah')) {
                $file_nikah = $request->file('file_nikah');
                $file_nikah_name = md5('ktp' . time()) . time() . '_' . $file_nikah->getClientOriginalName();
                $data['path_nikah'] = $file_nikah_name;
            }

            if ($request->hasFile('file_pengantar')) {
                $file_pengantar = $request->file('file_pengantar');
                $file_pengantar_name = md5('ktp' . time()) . time() . '_' . $file_pengantar->getClientOriginalName();
                $data['path_pengantar'] = $file_pengantar_name;
            }

            // status 0 = ditolak / revisi
            // status 1 = belum di approve
            // status 2 = sudah di approve disdukcapil

            $trx = Usulan::create([
                'uid' => Str::uuid()->toString(),
                'no_perkara' => $data['no_perkara'],
                'jenis_perkara' => $data['jenis_perkara'],
                'path_ktp' => $data['path_ktp'],
                'path_kk' => $data['path_kk'],
                'path_akta' => $data['path_akta'],
                'path_penetapan' => $data['path_penetapan'],
                'path_pendukung' => $data['path_pendukung'] ?? null,
                'path_nikah' => $data['path_nikah'],
                'path_pengantar' => $data['path_pengantar'],
                'pemohon_uid' => $data['pemohon_uid'],
                'disdukcapil_uid' => $data['delegasi'],
                'delegasi' => $data['delegasi'],
                'is_approve' => '1',
                'catatan' => json_encode([]),
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

                if ($request->hasFile('file_penetapan')) {
                    $file_penetapan = $request->file('file_penetapan');
                    $file_penetapan->move(public_path('upload/file_penetapan'), $data['path_penetapan']);
                }

                if ($request->hasFile('file_nikah')) {
                    $file_nikah = $request->file('file_nikah');
                    $file_nikah->move(public_path('upload/file_nikah'), $data['path_nikah']);
                }

                if ($request->hasFile('file_pengantar')) {
                    $file_pengantar = $request->file('file_pengantar');
                    $file_pengantar->move(public_path('upload/file_pengantar'), $data['path_pengantar']);
                }

                $disdukcapil = Disdukcapil::find($data['delegasi']);
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
                    $notif['jenis_perkara'] = $data['jenis_perkara'];
                    $notif['nama_disdukcapil'] = $disdukcapil->nama;
                    $notif['alamat_disdukcapil'] = $disdukcapil->alamat;
                    $notif['no_telp_disdukcapil'] = $disdukcapil->no_telp;
                    // Mail::to($disdukcapil->email)->send(new NotifEmail($notif));
                    try {
                        $options = [
                            'multipart' => [
                                [
                                    'name' => 'device_id',
                                    'contents' => '93ce715666c4811b544060462e10db8f'
                                ],
                                [
                                    'name' => 'number',
                                    'contents' => $disdukcapil->no_telp,
                                ],
                                [
                                    'name' => 'message',
                                    'contents' => 'Yang terhormat Bapak/Ibu, ada usulan baru dengan nomor perkara *' . $data['no_perkara'] . '* dari pemohon *' . $pemohon->name . '* yang perlu segera ditindaklanjuti. Terima kasih.'
                                ]
                            ]
                        ];
                        $client = new GuzzleClient([
                            'http_errors' => false
                        ]);
                        $res = $client->postAsync('https://app.whacenter.com/api/send', $options)->wait();
                    } catch (\Throwable $th) {
                        dd($th);
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
            // throw $th;
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
            $disdukcapil = Disdukcapil::all();
            $body = view('pages.administrasi.usulan.edit', compact('uid', 'data', 'pemohon', 'disdukcapil'))->render();
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
            'delegasi' => 'required',
            'file_ktp' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_kk' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_akta' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pendukung' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_penetapan' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_nikah' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pengantar' => 'mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ], [
            'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
            'no_perkara.unique' => 'Nomor Perkara sudah terdaftar',
            'jenis_perkara.required' => 'Jenis Perkara tidak boleh kosong',
            'pemohon_uid.required' => 'Pemohon tidak boleh kosong',
            'delegasi.required' => 'Kantor Disdukcapil tidak boleh kosong',
            'file_ktp.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_ktp.max' => 'Ukuran file ktp maksimal 2MB',
            'file_kk.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_kk.max' => 'Ukuran file kk maksimal 2MB',
            'file_akta.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_akta.max' => 'Ukuran file akta maksimal 2MB',
            'file_pendukung.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pendukung.max' => 'Ukuran file pendukung maksimal 2MB',
            'file_penetapan.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_penetapan.max' => 'Ukuran file penetapan maksimal 2MB',
            'file_nikah.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_nikah.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'file_pengantar.max' => 'Ukuran file penetapan maksimal 2MB',
            'file_pengantar.max' => 'Ukuran file penetapan maksimal 2MB',
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
            if ($request->hasFile('file_penetapan')) {
                $file = $request->file('file_penetapan');

                // Determine the new file name
                $filename = md5('penetapan' . time()) . time() . '_' . $file->getClientOriginalName();

                // Delete the old profile image if it exists
                if ($usulan->path_penetapan && file_exists(public_path('upload/file_penetapan/' . $usulan->path_penetapan))) {
                    unlink(public_path('upload/file_penetapan/' . $usulan->path_penetapan));
                }

                // Save the new file
                $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['path_penetapan'] = $filename;
            }
            if ($request->hasFile('file_nikah')) {
                $file = $request->file('file_nikah');

                // Determine the new file name
                $filename = md5('nikah' . time()) . time() . '_' . $file->getClientOriginalName();

                // Delete the old profile image if it exists
                if ($usulan->path_nikah && file_exists(public_path('upload/file_nikah/' . $usulan->path_nikah))) {
                    unlink(public_path('upload/file_nikah/' . $usulan->path_nikah));
                }

                // Save the new file
                $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['path_nikah'] = $filename;
            }
            if ($request->hasFile('file_pengantar')) {
                $file = $request->file('file_pengantar');

                // Determine the new file name
                $filename = md5('pengantar' . time()) . time() . '_' . $file->getClientOriginalName();

                // Delete the old profile image if it exists
                if ($usulan->path_pengantar && file_exists(public_path('upload/file_pengantar/' . $usulan->path_pengantar))) {
                    unlink(public_path('upload/file_pengantar/' . $usulan->path_pengantar));
                }

                // Save the new file
                $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['path_pengantar'] = $filename;
            }
            $name = auth()->user()->name;
            $role = auth()->user()->role->name;
            $catatan = json_decode($usulan->catatan);
            $catatan[] = [
                'role' => $role,
                'name' => $name,
                'status' => '99',
                'catatan' => '',
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $formData['catatan'] = json_encode($catatan);
            $formData['is_approve'] = '1';
            $formData['disdukcapil_uid'] = $formData['delegasi'];
            $formData['updated_by'] = auth()->user()->uid;

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
            if ($usulan->path_penetapan && file_exists(public_path('upload/file_penetapan/' . $usulan->path_penetapan))) {
                unlink(public_path('upload/file_penetapan/' . $usulan->path_penetapan));
            }
            if ($usulan->path_nikah && file_exists(public_path('upload/file_nikah/' . $usulan->path_nikah))) {
                unlink(public_path('upload/file_nikah/' . $usulan->path_nikah));
            }
            if ($usulan->path_pengantar && file_exists(public_path('upload/file_pengantar/' . $usulan->path_pengantar))) {
                unlink(public_path('upload/file_pengantar/' . $usulan->path_pengantar));
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

    public function approvement($uid)
    {
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);

        $usulan = Usulan::find($uid);
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

        $usulan = Usulan::find($uid);
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

    public function send_mail($uid)
    {
        if (!PermissionCommon::check('usulan.approve_disdukcapil')) abort(403);

        $usulan = Usulan::find($uid);
        if ($usulan) {
            $body = view('pages.administrasi.usulan.form_email', compact('usulan', 'uid'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="processMail()">Kirim Email <i class="fas fa-paper-plane"></i></button>';
            return [
                'title' => 'Kirim Email',
                'body' => $body,
                'footer' => $footer
            ];
        }
    }

    public function list(Request $request)
    {
        try {
            $search = request()->query('search');
            $role = auth()->user()->role->slug;
            $uid = Disdukcapil::whereRaw("LOWER(REPLACE(nama, ' ', '_')) = ?", [$role])
                ->value('uid');
            $usulan = Submission::select('uid', 'no_perkara', 'submission_type')
                ->with([
                    'documents' => function ($query) {
                        $query->select('submission_uid', 'document_type', 'document_name', 'file_path');
                    },
                    'perbaikanAktaDetail',
                    'aktaKematianDetail',
                    'aktaPerkawinanDetail',
                    'aktaPerceraianDetail',
                    'pengangkatanAnakDetail',
                    'pengakuanAnakDetail',
                    'pembatalanAktaKelahiranDetail',
                    'pembatalanPerceraianDetail',
                    'pembatalanPerkawinanDetail',
                ])
                ->where('disdukcapil_uid', $uid)
                ->when($search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('no_perkara', 'like', "%{$search}%")
                            ->orWhere('submission_type', 'like', "%{$search}%");
                    });
                })
                ->orderBy('created_at', 'desc')  // Add this line to sort by created_at field
                ->paginate(5);

            return new PostResource(true, 'Berhasil mengambil data usulan', $usulan);
        } catch (\Throwable $th) {
            dd($th);
            return new PostResource(false, 'Terjadi Kesalahan Internal', []);
        }
    }


    public function approvement_disduk(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $validate = Validator::make(
                $request->all(),
                [
                    'no_perkara' => 'required',
                    'catatan' => 'required',
                ],
                [
                    'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
                    'catatan.required' => 'Catatan tidak boleh kosong',
                ]
            );
            if ($validate->fails()) {
                return response([
                    'status' => false,
                    'message' => $validate->errors()->toJson()
                ], 400);
            }

            $formData = $request->except('_token', '_method');
            $usulan = Submission::where('no_perkara',$formData['no_perkara'])->first();
            if ($usulan) {
                if ($usulan->status == 2) {
                    return response([
                        'status' => false,
                        'message' => 'Data Sudah Disetujui'
                    ], 400);
                } else if ($usulan->status == 0) {
                    return response([
                        'status' => false,
                        'message' => 'Data Sudah Ditolak'
                    ], 400);
                }

                $name = auth()->user()->name;
                $role = auth()->user()->role->name;
                $slug = auth()->user()->role->slug;

                $formData['status'] = '2';

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
                    $jenis_permohonan = $usulan->submission_type;
                    $notif = [];
                    $notif['logo'] = $usulan->disdukcapil->cdn_picture;
                    $notif['approval'] = "approve";
                    $notif['daerah_disdukcapil'] = strtoupper(str_replace("disdukcapil", "", strtolower($usulan->disdukcapil->nama)));
                    $notif['alamat_disdukcapil'] = $usulan->disdukcapil->alamat;
                    $nama_disdukcapil = $usulan->disdukcapil->nama;
                    switch ($nama_disdukcapil) {
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
                    $notif['jenis_perkara'] = $jenis_permohonan;
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
                    🗃 Jenis Permohonan  : $jenis_permohonan

                    Terima kasih atas kerjasamanya.
                    $disdukcapil
                    EOT;
                    $nomor_pengadilan = env('NOMOR_PENGADILAN');
                    WhatsappHelper::sendSingleMessage($nomor_pengadilan, $message);
                    // if (in_array($jenis_permohonan, ['pengangkatan_anak', 'pengakuan_anak', 'pembatalan_akta_kelahiran', 'pembatalan_perceraian', 'pembatalan_perkawinan'])) {
                    // }
                    return new PostResource(true, 'Data Berhasil Disetujui', $trx);
                } else {
                    return new PostResource(false, 'Data Gagal Disetujui', []);
                }
            } else {
                return new PostResource(false, 'Data Tidak Ditemukan', []);
            }
        } catch (\Throwable $th) {
            throw $th;
            return new PostResource(false, 'Terjadi Kesalahan Internal', []);
        } catch (\Illuminate\Database\QueryException $e) {
            return new PostResource(false, 'Terjadi Kesalahan Internal', []);
        }
    }

    public function rejectment_disduk(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $validate = Validator::make(
                $request->all(),
                [
                    'no_perkara' => 'required',
                    'catatan' => 'required',
                ],
                [
                    'no_perkara.required' => 'Nomor Perkara tidak boleh kosong',
                    'catatan.required' => 'Catatan tidak boleh kosong',
                ]
            );
            if ($validate->fails()) {
                return response([
                    'status' => false,
                    'message' => $validate->errors()->toJson()
                ], 400);
            }

            $formData = $request->except('_token', '_method');
            $usulan = Submission::where('no_perkara',$formData['no_perkara'])->first();
            if ($usulan) {
                if ($usulan->status == 2) {
                    return response([
                        'status' => false,
                        'message' => 'Data Sudah Disetujui'
                    ], 400);
                } else if ($usulan->status == 0) {
                    return response([
                        'status' => false,
                        'message' => 'Data Sudah Ditolak'
                    ], 400);
                }
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
                    $jenis_permohonan = $usulan->submission_type;
                    $notif = [];
                    $notif['logo'] = $usulan->disdukcapil->cdn_picture;
                    $notif['approval'] = "reject";
                    $notif['daerah_disdukcapil'] = strtoupper(str_replace("disdukcapil", "", strtolower($usulan->disdukcapil->nama)));
                    $notif['alamat_disdukcapil'] = $usulan->disdukcapil->alamat;
                    $nama_disdukcapil = $usulan->disdukcapil->nama;
                    switch ($nama_disdukcapil) {
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
                    $notif['jenis_perkara'] = $jenis_permohonan;
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
                    🗃 Jenis Permohonan  : $jenis_permohonan

                    Terima kasih atas kerjasamanya.
                    $disdukcapil
                    EOT;
                    $nomor_pengadilan = env('NOMOR_PENGADILAN');
                    WhatsappHelper::sendSingleMessage($nomor_pengadilan, $message);
                    // if (in_array($jenis_permohonan, ['pengangkatan_anak', 'pengakuan_anak', 'pembatalan_akta_kelahiran', 'pembatalan_perceraian', 'pembatalan_perkawinan'])) {
                    // }
                    return new PostResource(true, 'Data Berhasil Ditolak', $trx);
                } else {
                    return new PostResource(false, 'Data Gagal Ditolak', []);
                }
            } else {
                return new PostResource(false, 'Data Tidak Ditemukan', []);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return new PostResource(false, 'Data Berhasil Disetujui', []);
        } catch (\Illuminate\Database\QueryException $e) {
            return new PostResource(false, 'Terjadi Kesalahan Internal', []);
        }
    }
}
