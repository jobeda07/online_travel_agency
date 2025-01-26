<?php

namespace App\Infra\Services;

use App\Infra\Repositories\CountryRepository;

class CountryService
{
    private CountryRepository $countryRepository;
    /**
     * @param CountryRepository $countryRepository
     */
    public function __construct(
        CountryRepository $countryRepository,
    ) {
        $this->countryRepository = $countryRepository;
    }

    public function allCountryGet()
    {
        $countries = $this->countryRepository->allCountryGet();
        return $countries;
    }
    public function storeCountry(array $data)
    {
        return $this->countryRepository->storeCountry($data);
    }
    public function findCountryById($id)
    {
        return $this->countryRepository->findCountryById($id);
    }

    public function updateCountry($id, array $data)
    {
        return $this->countryRepository->updateCountry($id, $data);
    }
    public function deleteCountry($id)
    {
        return $this->countryRepository->deleteCountry($id);
    }
    public function statusCountry($id)
    {
        return $this->countryRepository->statusCountry($id);
    }
}
