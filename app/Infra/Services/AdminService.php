<?php

namespace App\Infra\Services;

use App\Infra\Repositories\AdminRepository;

class AdminService
{
    private AdminRepository $AdminRepository;
    /**
     * @param AdminRepository $AdminRepository
     */
    public function __construct(
        AdminRepository $AdminRepository,
    ) {
        $this->AdminRepository = $AdminRepository;
    }

    public function allAdminGet()
    {
        $Admins = $this->AdminRepository->allAdminGet();
        return $Admins;
    }

    public function storeAdmin(array $data)
    {
        return $this->AdminRepository->storeAdmin($data);
    }
    public function findAdminById($id)
    {
        return $this->AdminRepository->findAdminById($id);
    }

    public function updateAdmin($id, array $data)
    {
        return $this->AdminRepository->updateAdmin($id, $data);
    }
    public function deleteAdmin($id)
    {
        return $this->AdminRepository->deleteAdmin($id);
    }
    public function allRoleGet()
    {
        $Admins = $this->AdminRepository->allRoleGet();
        return $Admins;
    }
}
