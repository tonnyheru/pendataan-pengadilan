<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Helpers\ActionLogger;
use App\Helpers\PermissionCommon;
use App\Helpers\Utils;
use App\Models\Module;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $dataTable)
    {
        if (!PermissionCommon::check('role.list')) abort(403);
        return $dataTable->render('pages.manajemen_user.role.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('role.create')) abort(403);
        $body = view('pages.manajemen_user.role.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Role',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!PermissionCommon::check('role.create')) abort(403);
        $request->validate([
            'name' => 'required',
        ]);
        $data = $request->except('_token');
        $slug = Utils::formatSlug($data['name']);
        try {
            $trx = Role::create([
                'uid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'slug' => $slug,
                'description' => $data['description'],
            ]);
            if ($trx) {
                ActionLogger::log('create', json_encode(['role_uid' => $trx->uid, 'nama_role' => $trx->name]));
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat Role'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Role'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal'
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
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (!PermissionCommon::check('role.update')) abort(403);
        if ($role) {
            $uid = $role->uid;
            $data = $role;
            $body = view('pages.manajemen_user.role.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Role',
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
    public function update(Request $request, Role $role)
    {
        if (!PermissionCommon::check('role.update')) abort(403);
        $request->validate([
            'name' => 'required',
        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $formData['slug'] = Utils::formatSlug($formData['name']);
            $trx = $role->update($formData);
            if ($trx) {
                ActionLogger::log('update', json_encode(['role_uid' => $role->uid, 'nama_role' => $role->name]));
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
    public function destroy(Role $role)
    {
        if (!PermissionCommon::check('role.delete')) abort(403);
        try {
            ActionLogger::log('delete', json_encode(['role_uid' => $role->uid, 'nama_role' => $role->name]));
            $delete = $role->delete();
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

    public function select2(Request $request)
    {
        $request->validate([
            'limit' => 'required',
            'page' => 'required'
        ]);

        $limit = $request->limit;
        $start = $limit * $request->page;
        $term = isset($request->term) ? $request->term : '';

        $roles = Role::all();
        if ($start) {
            $roles->skip($start);
        }

        if ($limit) {
            $roles->take($limit);
        }

        if ($term != '' && $term) {
            $roles = Role::where('name', 'like', '%' . $term . '%')->skip($start)->take($limit)->get();
        }

        $run = DataTables::of($roles)->addColumn('id', function ($role) {
            $uid = $role->uid;
            return (string) $uid; // Explicitly cast to string
        })->make(true);
        $decode = json_encode($run);
        $encode = json_decode($decode, true);

        $res['items'] = [];
        $res['total'] = 0;
        if (count($roles) > 0) {
            $res['items'] = $encode['original']['data'];
            $res['total'] = $encode['original']['recordsFiltered'];
        }
        return $res;
    }

    public function permission($role_uid)
    {
        if (!PermissionCommon::check('role.list')) abort(403);
        $role = Role::find($role_uid);
        $permission = Module::all()->sortBy('created_at');;
        $currPermit = RolePermission::where('role_uid', $role_uid)->get()->toArray();
        $currentPermit = [];
        foreach ($currPermit as $key => $value) {
            $currentPermit[] = $value['permission_uid'];
        }
        return view('pages.manajemen_user.role.permission', compact('role', 'permission', 'currentPermit'));
    }

    public function permission_store(Request $request, $role_uid)
    {
        if (!PermissionCommon::check('role.create')) abort(403);
        $request->validate([
            'permission' => 'required',
        ]);

        $formData = $request->except('_token', '_method');
        $rolePermit = [];
        foreach ($formData['permission'] as $key) {
            $rolePermit[] = [
                "permission_uid" => $key,
                "role_uid" => $role_uid
            ];
        }

        DB::table('role_permissions')->where('role_uid', $role_uid)->delete();
        $trx = RolePermission::insert($rolePermit);
        if ($trx) {
            return response([
                'status' => true,
                "message" => "Data Saved Successfully"
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => "Data Failed to Save"
            ], 400);
        }
    }
}
