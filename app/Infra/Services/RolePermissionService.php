<?php

namespace App\Infra\Services;

use App\Infra\Repositories\RolePermissionRepository;

class RolePermissionService
{
    private RolePermissionRepository $RolePermissionRepository;

    public function __construct(
        RolePermissionRepository $RolePermissionRepository,
    ) {
        $this->RolePermissionRepository = $RolePermissionRepository;
    }

    public function allRoleGet()
    {
        $roles = $this->RolePermissionRepository->allRoleGet();
        return $roles;
    }

    public function storeRole(array $data)
    {
        return $this->RolePermissionRepository->storeRole($data);
    }
    public function findRoleById($id)
    {
        return $this->RolePermissionRepository->findRoleById($id);
    }

    public function updateRole($id, array $data)
    {
        return $this->RolePermissionRepository->updateRole($id, $data);
    }

    public function deleteRole($id)
    {
        return $this->RolePermissionRepository->deleteRole($id);
    }

    public function allPermissionGet()
    {
        $permissions = $this->RolePermissionRepository->allPermissionGet();
        return $permissions;
    }
    public function givePermission($id, array $data)
    {
        return $this->RolePermissionRepository->givePermission($id, $data);
    }
}
