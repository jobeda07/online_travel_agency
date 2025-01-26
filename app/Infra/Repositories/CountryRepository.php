<?php

namespace App\Infra\Repositories;

use App\Models\Country;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Hash;

class CountryRepository
{
    use ImageUpload;
    private Country $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function allCountryGet()
    {
        $countries = $this->country->get();
        return $countries;
    }
    public function storeCountry(array $data)
    {
        $filename = "";
        $country = new Country();
        $country->name_en = $data['name_en'];
        $country->name_bn = $data['name_bn'];
        $country->phone_code = $data['phone_code'];
        if (array_key_exists('flag_img', $data)){
            $filename = $this->imageUpload($data['flag_img'], 400, 300, 'uploads/images/Flag/', true);
            $country->flag_img ='uploads/images/Flag/'.$filename;
        }
        $country->save();
        return $country;
    }

    public function findCountryById($id)
    {
        return $this->country->findOrFail($id);
    }

    public function updateCountry($id, array $data)
    {
        $filename = "";
        $country = $this->findCountryById($id);
        $country->name_en = $data['name_en'];
        $country->name_bn = $data['name_bn'];
        $country->phone_code = $data['phone_code'];
        if (array_key_exists('flag_img', $data)){
            $this->deleteOne($country->flag_img);
            $filename = $this->imageUpload($data['flag_img'], 400, 300, 'uploads/images/Flag/', true);
            $country->flag_img ='uploads/images/Flag/'.$filename;
        }else{
            $country->flag_img=$country->flag_img;
        }
        $country->save();
        return $country;
    }
    public function deleteCountry( $id)
    {
        $country = $this->country->find($id);
        if ($country) {
            $this->deleteOne($country->flag_img);
            return $country->delete();
        }
    }
    public function statusCountry( $id)
    {
        $country = $this->country->find($id);
        $country->status = $country->status == 1 ? 0 : 1;
        $country->save();
        return $country;
    }
}
