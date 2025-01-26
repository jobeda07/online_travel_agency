<?php

namespace App\Infra\Services;

use App\Infra\Repositories\SettingRepository;

class SettingService
{
    private SettingRepository $SettingRepository;
    /**
     * @param SettingRepository $SettingRepository
     */
    public function __construct(
        SettingRepository $SettingRepository,
    ) {
        $this->SettingRepository = $SettingRepository;
    }
    public function storeSetting(array $data)
    {
        return $this->SettingRepository->storeSetting($data);
    }
    public function firstID()
    {
        return $this->SettingRepository->firstID();
    }
    
    public function updateSetting(array $data)
    {
        return $this->SettingRepository->updateSetting($data);
    }
}
