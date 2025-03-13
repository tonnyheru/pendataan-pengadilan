<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsulanController;
use App\Http\Middleware\PengadilanAuth;
use App\Models\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.inventory');
    Route::resources(['user' => UserController::class]);
    Route::resources(['role' => RoleController::class]);
    Route::resources(['module' => ModuleController::class]);
    Route::resources(['permission' => PermissionController::class]);
    Route::resources(['mutasi' => MutasiController::class]);
    Route::resources(['pemohon' => PemohonController::class]);
    Route::resources(['usulan' => UsulanController::class]);

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
            throw $th;
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    })->name('catatan.preview');


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
