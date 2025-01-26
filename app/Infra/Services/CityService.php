<?php

namespace App\Infra\Services;

use App\Infra\Repositories\CityRepository;

class CityService
{
    private CityRepository $cityRepository;

    public function __construct(
        CityRepository $cityRepository,
    ) {
        $this->cityRepository = $cityRepository;
    }

    public function allCityGet()
    {
        $cities = $this->cityRepository->allCityGet();
        return $cities;
    }
    public function storeCity(array $data)
    {
        return $this->cityRepository->storeCity($data);
    }
    public function findCityById($id)
    {
        return $this->cityRepository->findCityById($id);
    }

    public function updateCity($id, array $data)
    {
        return $this->cityRepository->updateCity($id, $data);
    }
    public function deleteCity($id)
    {
        return $this->cityRepository->deleteCity($id);
    }
    public function statusCity($id)
    {
        return $this->cityRepository->statusCity($id);
    }
}
