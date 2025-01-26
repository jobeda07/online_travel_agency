<?php

namespace App\Infra\Repositories;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionRepository
{
    private Role $Role;
    private Permission $Permission;


    public function __construct(Role $Role, Permission $Permission)
    {
        $this->Role = $Role;
        $this->Permission = $Permission;
    }

    public function allRoleGet()
    {
        $roles = $this->Role->get();
        return $roles;
    }

    public function storeRole(array $data)
    {
        $Role = new Role();
        $Role->name = $data['name'];
        $Role->guard_name = 'admin';
        $Role->save();
        return $Role;
    }

    public function findRoleById($id)
    {
        return $this->Role->findOrFail($id);
    }

    public function updateRole($id, array $data)
    {
        $Role = $this->findRoleById($id);
        $Role->name = $data['name'];
        $Role->save();
        return $Role;
    }

    public function deleteRole($id)
    {
        $role = $this->Role->find($id);
        if ($role) {
            return $role->delete();
        }
    }

    public function allPermissionGet()
    {
        $permissions = $this->Permission->where('guard_name', 'admin')->get()->groupBy('module_name');
        return $permissions;
    }

    public function givePermission($id, array $data)
    {
        $Role = $this->findRoleById($id);
        $permissions = $data['permissions'];
        if($permissions){
            $Role->syncPermissions($permissions);
        }
        return $Role;
    }
}
