<?php

namespace App\Http\Controllers;

use App\DataTables\ModuleDataTable;
use App\Helpers\PermissionCommon;
use App\Helpers\Utils;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ModuleDataTable $dataTable)
    {
        if (!PermissionCommon::check('module.list')) abort(403);
        return $dataTable->render('pages.manajemen_user.module.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('module.create')) abort(403);
        $body = view('pages.manajemen_user.module.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Module',
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
        ]);
        $data = $request->except('_token');
        // $slug = Utils::formatSlug($data['name']);
        try {
            $trx = Module::create([
                'uid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'description' => $data['description'],
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
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        if (!PermissionCommon::check('module.update')) abort(403);
        if ($module) {
            $uid = $module->uid;
            $data = $module;
            $body = view('pages.manajemen_user.module.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Module',
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
    public function update(Request $request, Module $module)
    {
        if (!PermissionCommon::check('module.update')) abort(403);
        $request->validate([
            'name' => 'required',
        ]);
        $formData = $request->except(["_token", "_method"]);
        try {
            $trx = $module->update($formData);
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
    public function destroy(Module $module)
    {
        if (!PermissionCommon::check('module.delete')) abort(403);
        try {
            $delete = $module->delete();
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
