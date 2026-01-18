<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = new Role();
        return view('dashboard.roles.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Role::rules());

        Role::createWithAbilities($request);

        return redirect()->route('admin.roles.index')->with([
            'success' => 'Role Created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role_abilities = $role->abilities()->pluck('type', 'ability')->toArray();
        return view('dashboard.roles.edit', compact('role', 'role_abilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(Role::rules());

        $role->updateWithAbilities($request);

        return redirect()->route('admin.roles.index')->with([
            'success' => 'Role Updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->id);

        return redirect()->route('admin.roles.index')->with([
            'success' => 'Role Deleted successfully',
        ]);
    }
}
