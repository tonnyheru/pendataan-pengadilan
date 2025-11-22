<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsulanController;
use App\Mail\SendEmail;
use App\Models\Usulan;
use App\Models\Submission;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'loginApi']);
Route::post('logout', [AuthController::class, 'logoutApi'])->middleware('auth:api');

Route::prefix('/')->middleware('auth:api')->group(function () {
    Route::post('/usulan', [UsulanController::class, 'list']);
    Route::prefix('approvement')->group(function () {
        Route::put('/approve_usulan', [UsulanController::class, 'approvement_disduk']);
        Route::put('/reject_usulan', [UsulanController::class, 'rejectment_disduk']);
    });
    Route::post('/send-email', function (Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'no_perkara' => 'required',
                'attachments'   => 'required|array|min:1|max:3', // Minimal 1 file, maksimal 3 file
                'attachments.*' => 'file|mimes:jpeg,png,gif,pdf|max:2048', // Format: JPG, PNG, GIF, PDF (maks 2MB)
            ],
            [
                'no_perkara.required' => 'Nomor Perkara Wajib Diisi',
                'attachments.required' => 'File Lampiran Wajib Diisi',
                'attachments.array' => 'File Lampiran Harus Berupa Array',
                'attachments.min' => 'Minimal 1 File Lampiran',
                'attachments.max' => 'Maksimal 3 File Lampiran',
                'attachments.*.file' => 'File Lampiran Harus Berupa File',
                'attachments.*.mimes' => 'Format File Lampiran Harus Berupa JPG, PNG, GIF, PDF',
                'attachments.*.max' => 'Maksimal Ukuran File Lampiran 2MB',
            ]
        );
        if ($validate->fails()) {
            return response([
                'status' => false,
                'message' => $validate->errors()->toJson()
            ], 400);
        }
        $data = $request->except('_token');
        $usulan = Submission::where('no_perkara',$data['no_perkara'])->first();
        if ($usulan) {
            if ($usulan->status != '2') {
                return response([
                    'status' => false,
                    'message' => 'Usulan Belum Disetujui'
                ], 400);
            }
            $attach = [];
            $kepada = $usulan->pemohon->email;
            $data['logo'] = $usulan->disdukcapil->cdn_picture;
            $data['title'] = $usulan->disdukcapil->nama;
            $data['nama'] = $usulan->pemohon->name;
            $data['alamat'] = $usulan->pemohon->alamat;
            $data['no_telp'] = $usulan->pemohon->no_telp;
            $data['email'] = $usulan->pemohon->email;
            $data['no_perkara'] = $usulan->no_perkara;
            $data['jenis_perkara'] = $usulan->jenis_perkara;
            $data['nama_disdukcapil'] = $usulan->disdukcapil->nama;
            $data['alamat_disdukcapil'] = $usulan->disdukcapil->alamat;
            $data['no_telp_disdukcapil'] = $usulan->disdukcapil->no_telp;

            // dd($request->file('attachments'));

            foreach ($request->file('attachments') as $file) {
                $filename = md5(bin2hex(random_bytes(10))) . '_' . date('Y-m-d') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/email'), $filename);
                $attach[] = 'upload/email/' . $filename;
                $data['attach'][] = $filename;
            }
            unset($data['attachments']);

            // dd($data);
            Mail::to($kepada)->send(new SendEmail($data));
            try {
                $options = [
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
                            'contents' => 'Yang terhormat Bapak/Ibu *' . $usulan->pemohon->name . '*, Terima kasih telah menggunakan layanan kami, mohon cek email untuk dokumen yang sudah diperbaharui.'
                        ]
                    ]
                ];
                $client = new Client([
                    'http_errors' => false
                ]);
                $res = $client->postAsync('https://app.whacenter.com/api/send', $options)->wait();
            } catch (\Throwable $th) {
                //throw $th;
            }

            foreach ($data['attach'] as $file) {
                unlink(public_path('upload/email/' . $file));
            }
            return response([
                'status' => true,
                'message' => 'Berhasil Mengirim Email'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Data Usulan Tidak Ditemukan',
            ], 400);
        }
        try {
        } catch (\Throwable $th) {
            dd($th);
            return response([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    });
});
