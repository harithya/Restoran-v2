<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Menampilkan data datatables
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
     * Melakukan proses tambah data
     *
     * @param Request $request
     * @return object
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
     * Mengambil data berdasarkan id
     *
     * @param int $id
     * @return object
     */
    public function show($id)
    {
        return Role::find($id);
    }

    /**
     * Melakukan update data berdasarkan id
     *
     * @param Request $request
     * @param int $id
     * @return object
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
     * Melakukan hapus data berdasarkan id
     *
     * @param int $id
     * @return object
     */
    public function destroy($id)
    {
        $delete = Role::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
