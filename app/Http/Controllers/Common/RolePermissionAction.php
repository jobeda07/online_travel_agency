<?php

namespace App\Http\Controllers\Common;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\GivePermissionRequest;
use Spatie\Permission\Models\Permission;
use App\Infra\Services\RolePermissionService;

class RolePermissionAction extends Controller
{
    private RolePermissionService $rolePermissionService;
    public function __construct(RolePermissionService $rolePermissionService)
    {
        $this->rolePermissionService = $rolePermissionService;
    }

    public function index()
    {
        $data['roles'] = $this->rolePermissionService->allRoleGet();
        return view('common.rolePermission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $data)
    {
        try {
            $this->rolePermissionService->storeRole($data->validated());
            return redirect()->back()->with('success', 'Role Create successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store Role.');
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:18|min:4|unique:roles,name,' . $id,
        ]);
        try {
            $this->rolePermissionService->updateRole($id, $validatedData);
            return redirect()->back()->with('success', 'Role Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update Role.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $this->rolePermissionService->deleteRole($id);
            return redirect()->back()->with('success', 'Role Delete successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Role.');
        }
    }
    public function show_permission($id)
    {
        if (in_array($id, [1])) {
            return abort(404);
        }
        $data['role'] = $this->rolePermissionService->findRoleById($id);
        $data['permissions'] = $this->rolePermissionService->allPermissionGet();
        return view('common.rolePermission.permissionPage', $data);
    }
    public function give_permission(GivePermissionRequest $data, $id)
    {

        try {
            $this->rolePermissionService->givePermission($id, $data->validated());
            return redirect()->back()->with('success', 'Permission Change successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store Role.');
        }
    }
}
