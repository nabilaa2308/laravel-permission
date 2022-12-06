<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('permission:role_show', ['only' => 'index']);
        $this->middleware('permission:role_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role_delete', ['only' => 'destroy']);
        $this->middleware('permission:role_detail', ['only' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index', [
            'roles' => Role::all()->where('name', '<>', 'Super Admin'),
            'title' => 'Role'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Role::all();
        $authorities = config('permission.authorities');
        return view('role.create', [
            'roles' => $data,
            'authorities' => $authorities,
            'title' => 'Role'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string|max:50|unique:roles,name",

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permissions);

        return redirect('/role');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $authorities = config('permission.authorities');
        $rolePermission = $role->permissions->pluck('name')->toArray();
        return view('role.detail', [
            'roles' => $role,
            'authorities' => $authorities,
            'rolePermissions' => $rolePermission,
            'title' => 'Role'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $authorities = config('permission.authorities');
        return view('role.edit', [
            'role' => $role,
            'authorities' => $authorities,
            'permissionsChecked' => $role->permissions->pluck('name')->toArray(),
            'title' => 'Role'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->syncPermissions($request->permissions);
        $role->save();

        return redirect('/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->revokePermissionTo($role->permissions->pluck('name')->toArray());
        $role->delete();
        return redirect('/role');
    }
}
