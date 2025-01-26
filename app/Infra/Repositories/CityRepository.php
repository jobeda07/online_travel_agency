<?php

namespace App\Infra\Repositories;

use App\Models\City;

class CityRepository
{
    private City $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function allCityGet()
    {
        $cities = $this->city->get();
        return $cities;
    }
    public function storeCity(array $data)
    {
        $city = new City();
        $city->name_en = $data['name_en'];
        $city->name_bn = $data['name_bn'];
        $city->country_id = $data['country_id'];
        $city->description_en = $data['description_en'];
        $city->description_bn = $data['description_bn'];
        $city->save();
        return $city;
    }

    public function findCityById($id)
    {
        return $this->city->findOrFail($id);
    }

    public function updateCity($id, array $data)
    {
        $city = $this->findCityById($id);
        $city->name_en = $data['name_en'];
        $city->name_bn = $data['name_bn'];
        $city->country_id = $data['country_id'];
        $city->description_en = $data['description_en'];
        $city->description_bn = $data['description_bn'];
        $city->save();
        return $city;
    }
    public function deleteCity( $id)
    {
        $city = $this->city->find($id);
        if ($city) {
            return $city->delete();
        }
    }
    public function statusCity( $id)
    {
        $city = $this->city->find($id);
        $city->status = $city->status == 1 ? 0 : 1;
        $city->save();
        return $city;
    }
}
