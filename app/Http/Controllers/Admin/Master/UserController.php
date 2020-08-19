<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\User;
use App\Role;


class UserController extends Controller
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
            $user = User::getAll();
            return DataTables::of($user)
                ->addIndexColumn()
                ->toJson();
        }
        $role = Role::all();
        return view('admin.master.user.index', compact('role'));
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
            'username' => 'required|unique:users|string',
            'password' => 'required|min:4',
            'role' => 'required'
        ]);

        $create = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role_id' => $request->role
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
        return User::find($id);
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
            'username' => 'required|unique:users|string',
            'role' => 'required'
        ]);

        $update = User::find($id)->update([
            'username' => $request->username,
            'role_id' => $request->role,
        ]);

        return response()->json(['status' => true]);
    }

    /**
     * Melakukan hapus data berdasarkan id
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['status' => true]);
    }

    /**
     * Reset password random berdasarkan id
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function reset(Request $request, $id)
    {
        if ($request->ajax()) {
            $password = Str::random(8);
            User::find($id)->update(['password' => bcrypt($password)]);
            return response()->json(['status' => true, 'result' => $password]);
        }
    }
}
