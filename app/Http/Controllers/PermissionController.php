<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Helpers\PermissionCommon;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionDataTable $dataTable, Request $request)
    {
        if (!PermissionCommon::check('module.list')) abort(403);
        $uid = $request->query('dd');
        $module = Module::find($uid);
        if (!$module) {
            return redirect()->route('module.index')->with('error', 'Module tidak ditemukan');
        }
        return $dataTable->render('pages.manajemen_user.permission.list', compact('uid', 'module'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!PermissionCommon::check('module.create')) abort(403);
        $uid = $request->query('dd');
        $body = view('pages.manajemen_user.permission.create', compact('uid'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Permission',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!PermissionCommon::check('module.create')) abort(403);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $data = $request->except('_token');
        // $slug = Utils::formatSlug($data['name']);
        try {
            $trx = Permission::create([
                'uid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'description' => $data['description'],
                'slug' => $data['slug'],
                'module_uid' => $data['uid'],
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat Module'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Module'
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
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        if (!PermissionCommon::check('module.update')) abort(403);
        if ($permission) {
            $uid = $permission->uid;
            $data = $permission;
            $body = view('pages.manajemen_user.permission.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Permission',
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
    public function update(Request $request, Permission $permission)
    {
        if (!PermissionCommon::check('module.update')) abort(403);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $trx = $permission->update($formData);
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
    public function destroy(Permission $permission)
    {
        if (!PermissionCommon::check('module.delete')) abort(403);
        try {
            $delete = $permission->delete();
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
}
