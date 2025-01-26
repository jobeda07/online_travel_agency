<?php

namespace App\Infra\Repositories;

use App\Models\keyValue;
use App\Models\Language;
use App\Models\TranslateData;

class LanguageRepository
{
    private Language $language;
    private keyValue $keyValue;
    private TranslateData $translateData;

    public function __construct(Language $language, keyValue $keyValue, TranslateData $translateData)
    {
        $this->language = $language;
        $this->keyValue = $keyValue;
        $this->translateData = $translateData;
    }

    public function alllanguageGet()
    {
        $languages = $this->language->get();
        return $languages;
    }
    public function storelanguage(array $data)
    {
        $language = new language();
        $language->name = $data['name'];
        $language->lang_code = $data['lang_code'];
        $language->save();
        return $language;
    }

    public function findlanguageById($id)
    {
        return $this->language->findOrFail($id);
    }

    public function updatelanguage($id, array $data)
    {
        $language = $this->findlanguageById($id);
        $language->name = $data['name'];
        $language->lang_code = $data['lang_code'];
        $language->save();
        return $language;
    }
    public function deletelanguage($id)
    {
        $language = $this->language->find($id);
        return $language->delete();
    }
    public function statuslanguage($id)
    {
        $language = $this->language->find($id);
        $language->status = $language->status == 1 ? 0 : 1;
        $language->save();
        return $language;
    }
    public function allkeyValueGet($id)
    {
        $language = $this->language->find($id);
        $lang_code=$language->lang_code;
        $keyValues = $this->keyValue->with(['translations' => function ($query) use ($lang_code) {
            $query->where('lang_code', $lang_code);
        }])->get();
        return $keyValues;
    }
    public function findlanguageData($id)
    {
        $translateDatas = $this->translateData->where('lang_code', $id)->get();
        return $translateDatas;
    }

    // public function translationStore(string $id, array $data)
    // {
    //     $keys = $data['key'] ?? [];
    //     $descriptions = $data['description'] ?? [];
    //     $existingTranslations = $this->translateData->where('lang_code', $id)->get()->keyBy('key');

    //     foreach ($keys as $index => $key) {
    //         $description = $descriptions[$index] ?? '';
    //         if ($existingTranslations->has($key)) {
    //             $translate = $existingTranslations->get($key);
    //             $translate->description = $description;
    //             $translate->save();
    //         } else {
    //             $translate = new TranslateData();
    //             $translate->lang_code = $id;
    //             $translate->key = $key;
    //             $translate->description = $description;
    //             $translate->save();
    //         }
    //     }
    //     return true;
    // }
    public function translationStore(string $id, array $data)
    {
        $keys = $data['key'] ?? [];
        $descriptions = $data['description'] ?? [];
        foreach ($keys as $index => $key) {
            $description = $descriptions[$index] ?? '';
            TranslateData::updateOrCreate(
                ['lang_code' => $id, 'key' => $key],
                ['description' => $description]
            );
        }
        return true;
    }
}
