<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        $auth = AuthCommon::user();
        if (isset($auth->username)) {
            return redirect('app/dashboard');
        }
        return view("auth.login");
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('username', 'password');

        if (AuthCommon::check_credential($credential)) {
            $user = AuthCommon::getUser();
            $slug = [];
            $permit = RolePermission::where('role_uid', $user->role->uid)->get();
            foreach ($permit as $k => $v) {
                $slug[] = $v->permissions->slug;
            }
            AuthCommon::setUser($user);
            app('session')->put('slug_permit', $slug);
            return redirect('/app/dashboard');
            // if(in_array($user->role_id, [2,3])){
            // } 

            AuthCommon::logout();
        }

        // if (AuthCommon::check_credential($credential)) {
        //     $user = AuthCommon::getUser();
        //     AuthCommon::setUser($user);
        //     $role = $user->role->slug;
        //     app('session')->put('role_permit', $role);
        //     if ($role == "client") {
        //         return redirect('/inventory/backup-data');
        //     } else {
        //         return redirect('/inventory/dashboard');
        //     }

        //     AuthCommon::logout();
        // }


        return redirect('/login')
            ->withInput()
            ->withErrors(['login_failed' => 'Username atau password anda salah.']);
    }

    public function logout()
    {
        AuthCommon::logout();
        return redirect('/login');
    }

    public function loginApi(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Coba login dengan guard 'api'
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Username atau password anda salah'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logoutApi()
    {
        try {
            Auth::guard('api')->logout();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil logout'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal untuk logout'
            ]);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
