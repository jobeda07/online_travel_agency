<?php

namespace App\Infra\Services;

use App\Infra\Repositories\LanguageRepository;

class LanguageService
{
    private LanguageRepository $languageRepository;
    /**
     * @param LanguageRepository $languageRepository
     */
    public function __construct(
        LanguageRepository $languageRepository,
    ) {
        $this->languageRepository = $languageRepository;
    }

    public function alllanguageGet()
    {
        $languages = $this->languageRepository->alllanguageGet();
        return $languages;
    }

    public function storelanguage(array $data)
    {
        return $this->languageRepository->storelanguage($data);
    }
    public function findlanguageById($id)
    {
        return $this->languageRepository->findlanguageById($id);
    }

    public function updatelanguage($id, array $data)
    {
        return $this->languageRepository->updatelanguage($id, $data);
    }
    public function deletelanguage($id)
    {
        return $this->languageRepository->deletelanguage($id);
    }
    public function statuslanguage($id)
    {
        return $this->languageRepository->statuslanguage($id);
    }
    public function allkeyValueGet($id)
    {
        $keyValues = $this->languageRepository->allkeyValueGet($id);
        return $keyValues;
    }
    public function findlanguageData($id)
    {
        return $this->languageRepository->findlanguageData($id);
    }
    public function translationStore($id ,array $data)
    {
        return $this->languageRepository->translationStore($id ,$data);
    }
}
