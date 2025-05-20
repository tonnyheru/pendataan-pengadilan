<?php

use App\Http\Controllers\AktaKematianDetailController;
use App\Http\Controllers\AktaPerceraianDetailController;
use App\Http\Controllers\AktaPerkawinanDetailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisdukcapilController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PembatalanAktaKelahiranDetailController;
use App\Http\Controllers\PembatalanPerceraianDetailController;
use App\Http\Controllers\PembatalanPerkawinanDetailController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\PengakuanAnakDetailController;
use App\Http\Controllers\PengangkatanAnakDetailController;
use App\Http\Controllers\PerbaikanAktaDetailController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubmissionDocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsulanController;
use App\Http\Middleware\PengadilanAuth;
use App\Mail\MailPemohon;
use App\Models\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect()->route('auth.login');
});
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login_process', [AuthController::class, 'login_process'])->name('auth.login_process');

Route::prefix('app')->middleware(PengadilanAuth::class)->group(function () {
    Route::prefix('usulan')->group(function () {
        Route::resources(['submission' => SubmissionController::class]);
        Route::resources(['submission_documents' => SubmissionDocumentController::class]);
        Route::resources(['perbaikan_akta' => PerbaikanAktaDetailController::class]);
        Route::resources(['akta_kematian' => AktaKematianDetailController::class]);
        Route::resources(['akta_perkawinan' => AktaPerkawinanDetailController::class]);
        Route::resources(['akta_perceraian' => AktaPerceraianDetailController::class]);
        Route::resources(['pengangkatan_anak' => PengangkatanAnakDetailController::class]);
        Route::resources(['pengakuan_anak' => PengakuanAnakDetailController::class]);
        Route::resources(['pembatalan_akta_kelahiran' => PembatalanAktaKelahiranDetailController::class]);
        Route::resources(['pembatalan_perceraian' => PembatalanPerceraianDetailController::class]);
        Route::resources(['pembatalan_perkawinan' => PembatalanPerkawinanDetailController::class]);
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.inventory');
    Route::resources(['user' => UserController::class]);
    Route::resources(['role' => RoleController::class]);
    Route::resources(['module' => ModuleController::class]);
    Route::resources(['permission' => PermissionController::class]);
    Route::resources(['mutasi' => MutasiController::class]);
    Route::resources(['pemohon' => PemohonController::class]);
    Route::resources(['usulan' => UsulanController::class]);
    Route::resources(['disdukcapil' => DisdukcapilController::class]);


    Route::get('/file/{filename}/{type}', function ($filename, $type) {
        $file_path = public_path("upload/$type/$filename");
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($extension == 'pdf') {
            // create variable named body, and assign the value of iframe sourced into file_path
            $body = '<iframe src="' . url("upload/$type/$filename") . '" class="embed-responsive-item" style="width: 100%; height: 100vh;"></iframe>';
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            return [
                'title' => 'Preview Dokumen',
                'body' => $body,
                'footer' => $footer
            ];
        } else {
            $body = '<img src="' . url("upload/$type/$filename") . '" class="img-fluid" alt="Responsive image">';
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            return [
                'title' => 'Preview Dokumen',
                'body' => $body,
                'footer' => $footer
            ];
        }
        // return response()->file(public_path("upload/$filename"));
    })->name('file.preview');

    Route::get('/catatan/{uid}', function ($uid) {
        try {
            $usulan = Usulan::find($uid);
            if ($usulan) {
                $catatan = json_decode($usulan->catatan);
                $body = view('pages.administrasi.usulan.catatan', compact('usulan', 'catatan'))->render();
                $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                return [
                    'title' => 'Lihat Catatan',
                    'body' => $body,
                    'footer' => $footer
                ];
            }
        } catch (\Throwable $th) {
            // throw $th;
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    })->name('catatan.preview');


    Route::get('/send_email/{uid}', [UsulanController::class, 'send_mail'])->name('usulan.sendmail');
    Route::post('/send_email/{uid}', function (Request $request, $uid) {
        $request->validate([
            'attachments'   => 'required|array|min:1|max:3', // Minimal 1 file, maksimal 3 file
            'attachments.*' => 'file|mimes:jpeg,png,gif,pdf|max:2048', // Format: JPG, PNG, GIF, PDF (maks 2MB)
        ], [
            'attachments.required' => 'File Lampiran Wajib Diisi',
            'attachments.array' => 'File Lampiran Harus Berupa Array',
            'attachments.min' => 'Minimal 1 File Lampiran',
            'attachments.max' => 'Maksimal 3 File Lampiran',
            'attachments.*.file' => 'File Lampiran Harus Berupa File',
            'attachments.*.mimes' => 'Format File Lampiran Harus Berupa JPG, PNG, GIF, PDF',
            'attachments.*.max' => 'Maksimal Ukuran File Lampiran 2MB',
        ]);
        $data = $request->except('_token');
        $usulan = Usulan::find($uid);
        if ($usulan) {
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
    })->name('usulan.sendmail_process');



    Route::prefix('approvement')->group(function () {
        Route::get('/approve_usulan/{uid}', [UsulanController::class, 'approvement'])->name('usulan.approvement');
        Route::put('/approve_usulan/{uid}', [UsulanController::class, 'approvement_store'])->name('usulan.approvement_store');

        Route::get('/reject_usulan/{uid}', [UsulanController::class, 'rejectment'])->name('usulan.rejectment');
        Route::put('/reject_usulan/{uid}', [UsulanController::class, 'rejectment_store'])->name('usulan.rejectment_store');
    });
    Route::prefix('role')->group(function () {
        Route::get('/permission/{uid}', [RoleController::class, 'permission'])->name('role.permission');
        Route::put('/permission/{uid}', [RoleController::class, 'permission_store'])->name('role.update_permission');
    });
    Route::prefix('select2')->group(function () {
        Route::get('/role', [RoleController::class, 'select2'])->name('select2.role');
    });

    Route::get('/form_profile', [UserController::class, 'edit_profile'])->name('form.profile');
    Route::get('/form_password', [UserController::class, 'form_password'])->name('password.profile');
    Route::put('/update_profile/{uid}', [UserController::class, 'update_profile'])->name('update.profile');
    Route::put('/profile/change_password/{uid}', [UserController::class, 'change_password'])->name('changepass.profile');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
});

// Route::get('/', function () {
//     return redirect()->route('login');
// })->name('home');

// Route::middleware(['auth'])->group(function () {
//     Route::get('anggota', [StudentsController::class, 'index'])->name('anggota.index');
//     Route::get('anggota/create', [StudentsController::class, 'create'])->name('anggota.create');
//     Route::post('anggota/store', [StudentsController::class, 'store'])->name('anggota.store');
//     Route::get('anggota/edit/{id}', [StudentsController::class, 'edit'])->name('anggota.edit');
//     Route::patch('anggota/update/{id}', [StudentsController::class, 'update'])->name('anggota.update');
//     Route::delete('anggota/delete/{id}', [StudentsController::class, 'destroy'])->name('anggota.destroy');
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });


// Route::middleware(['guest'])->group(function () {
//     Route::get('/login', [AuthController::class, 'index'])->name('login');
//     Route::post('/login', [AuthController::class, 'authenticate']);
//     Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
//     Route::post('/register', [AuthController::class, 'register']);
// });

// Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
