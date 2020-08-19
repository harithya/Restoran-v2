<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Menampilkan data dengan datatables
     *
     * @param Request $request
     * @return object
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $role = Role::all();
            return DataTables::of($role)
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.master.role.index');
    }

    /**
     * untuk melakukan proses tambah data
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'role' => 'required|unique:role',
        ]);

        $create = Role::create([
            'role' => $request->role
        ]);

        return response()->json(['status' => true]);
    }

    /**
     * Menampilkan data untuk di update
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return Role::find($id);
    }

    /**
     * Untuk melakukan proses update data
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'role' => 'required|unique:role,role,' . $id,
        ]);

        $update = Role::find($id)->update([
            'role' => $request->role,
        ]);

        return response()->json(['status' => true]);
    }

    /**
     * Untuk melakukan hapus data
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $delete = Role::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
