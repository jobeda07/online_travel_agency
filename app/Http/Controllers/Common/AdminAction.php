<?php

namespace App\Http\Controllers\Common;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use App\Infra\Services\AdminService;

class AdminAction extends Controller
{
    private AdminService $adminService;
    /**
     * Create a new controller instance.
     *
     * @param AdminService $AdminService
     * @return void
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['admins'] = $this->adminService->allAdminGet();
        return view('common.admin.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] =$this->adminService->allRoleGet();
        return view('common.admin.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $data)
    {
        //dd($data->all());
       try {
            $this->adminService->storeAdmin($data->validated());
            return redirect()->route('user.list')->with('success', 'User Create successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store User.');
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
        if (in_array($id, [1])) {
            return abort(404);
        }
        $data['admin'] = $this->adminService->findAdminById($id);
        $data['roles'] =$this->adminService->allRoleGet();
        return view('common.admin.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:80',
            'phone' => 'required|digits:11|unique:Admins,phone,' . $id,
            'email' => 'required|email|unique:Admins,email,' . $id,
            'username' => 'nullable|string|max:20|unique:Admins,username,' . $id,
            'password' => 'nullable|string|min:6|max:20',
            'address' => 'required|max:700',
            'role' => 'required',
        ]);
        try {
            $this->adminService->updateAdmin($id, $validatedData);
            return redirect()->route('user.list')->with('success', 'User updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update User.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->adminService->deleteAdmin($id);
            return redirect()->route('user.list')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete User.');
        }
    }
}
