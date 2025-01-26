<?php

namespace App\Infra\Repositories;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    private Admin $Admin;
    private Role $Role;

    public function __construct(Admin $Admin ,Role $Role)
    {
        $this->Admin = $Admin;
        $this->Role = $Role;
    }

    public function allAdminGet()
    {
        //$admins = $this->Admin->get();
        $admins = $this->Admin->where('id', '!=', 1)->get();
        return $admins;
    }

    public function storeAdmin(array $data)
    {
        $admin = new Admin();
        $admin->name = $data['name'];
        $admin->phone = $data['phone'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->username = $data['username'];
        $admin->address = $data['address'];
        $admin->save();
        $admin->assignRole($data['role']);
        return $admin;
    }

    public function findAdminById($id)
    {
        return $this->Admin->findOrFail($id);
    }

    public function updateAdmin($id, array $data)
    {
        $admin = $this->findAdminById($id);
        $admin->name = $data['name'];
        $admin->phone = $data['phone'];
        $admin->email = $data['email'];
        $admin->username = $data['username'];
        $admin->address = $data['address'];
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $admin->save();
        $admin->syncRoles($data['role']);
        return $admin;
    }
    public function deleteAdmin( $id)
    {
        $admin = $this->Admin->find($id);
        if ($admin) {
            $admin->syncRoles([]);
            return $admin->delete();
        }
    }
    public function allRoleGet()
    {
        $Roles = $this->Role->where('name','!=','superAdmin')->get();
        return $Roles;
    }
}
