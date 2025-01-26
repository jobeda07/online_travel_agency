<?php

namespace App\Infra\Repositories;

use App\Models\Setting;
use App\Traits\ImageUpload;

class SettingRepository
{
    use ImageUpload;
    private Setting $Setting;

    public function __construct(Setting $Setting)
    {
        $this->Setting = $Setting;
    }
    public function firstID()
    {
        return $this->Setting->first();
    }

    public function storeSetting(array $data)
    {
        $this->handleSettings($data);
        $this->handleImageSetting('header_logo', $data, 70, 80);
        $this->handleImageSetting('footer_logo', $data, 700, 800);
        $this->handleImageSetting('fav_icon', $data, 70, 80);
    }

    public function updateSetting(array $data)
    {
        $this->handleSettings($data, true);
        $this->handleImageSetting('header_logo', $data, 70, 80, true);
        $this->handleImageSetting('footer_logo', $data, 700, 800, true);
        $this->handleImageSetting('fav_icon', $data, 70, 80, true);
    }

    private function handleSettings(array $data)
    {
        if (isset($data['type'])) {
            foreach ($data['type'] as $type) {
                if (isset($data[$type])) {
                    $value = $data[$type];
                    $this->updateOrCreateSetting($type, $value);
                }
            }
        }
    }

    private function updateOrCreateSetting($type, $value)
    {
        $this->Setting->updateOrCreate(
            ['name' => $type],
            ['value' => $value]
        );
    }

    private function handleImageSetting($name, array $data, $width, $height, $isUpdate = false)
    {
        if (array_key_exists($name, $data)) {
            $imagePath = $this->imageUpload($data[$name], $width, $height, 'backend/images/setting/', true);
            $setting = $this->Setting->where('name', $name)->first();

            if ($setting) {
                if ($isUpdate) {
                    $this->deleteOne($setting->value);
                }
                $setting->value ='backend/images/setting/'.$imagePath;
                $setting->save();
            }else {
                $this->Setting->create([
                    'name' => $name,
                    'value' => 'backend/images/setting/' . $imagePath,
                ]);
            }
        } elseif ($isUpdate) {
            $this->keepExistingSetting($name);
        }
    }

    private function keepExistingSetting($name)
    {
        $setting = $this->Setting->where('name', $name)->first();
        if ($setting) {
            $setting->save();
        }
    }
}
