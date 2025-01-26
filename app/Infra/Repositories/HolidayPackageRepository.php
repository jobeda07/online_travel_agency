<?php

namespace App\Infra\Repositories;
use Illuminate\Support\Str;
use App\Models\HolidayPackage;
use App\Traits\ImageUpload;

class HolidayPackageRepository{
    use ImageUpload;
     private  HolidayPackage $holidayPackage;
     
     public function __construct(HolidayPackage $holidayPackage){
        $this->holidayPackage=$holidayPackage;
     }
     public function allHolidayPackageGet(){
          $holidayPackages= $this->holidayPackage->get();
          return  $holidayPackages;
     }
    public function storeHolidayPackage(Array $data){
        $holidayPackage = new holidayPackage();
        $holidayPackage->title = $data['title'];
        $holidayPackage->slug = Str::slug($data['title']);
        $holidayPackage->price = $data['price'];
        $holidayPackage->validaty_start = $data['validaty_start'];
        $holidayPackage->validaty_end = $data['validaty_end'];
        $holidayPackage->total_days = $data['total_days'];
        $holidayPackage->priority = $data['priority'];
        $holidayPackage->country_id = $data['country_id'];
        $holidayPackage->city_id = $data['city_id'];
        $holidayPackage->description = $data['description'];
        if (array_key_exists('thambnail_img', $data)){
            $filename = $this->imageUpload($data['thambnail_img'], 400, 300, 'uploads/images/HolidayPackage/thambnail_img/', true);
            $holidayPackage->thambnail_img ='uploads/images/HolidayPackage/thambnail_img/'.$filename;
        }
        if (array_key_exists('slider_img', $data)){
           // dd($data['slider_img']);
            $images = [];
            foreach ($data['slider_img'] as $file_data) {
                //dd($file_data);
                $filename = $this->imageUpload($file_data, 500, 500, 'uploads/images/HolidayPackage/slider_img/', true);
                $images[] = 'uploads/images/HolidayPackage/slider_img/' . $filename;
            }
            $holidayPackage->slider_img = json_encode($images);
        }
        $holidayPackage->save();
        return $holidayPackage;
    }
    public function findHolidayPackageById($id)
    {
        return $this->holidayPackage->find($id);
    }

    public function updateHolidayPackage($id, array $data)
    {
        $holidayPackage=$this->holidayPackage->find($id);
        $holidayPackage->title = $data['title'] ??  $holidayPackage->title;
        $holidayPackage->slug = Str::slug($data['title']) ??$holidayPackage->slug ;
        $holidayPackage->price = $data['price'] ?? $holidayPackage->price;
        $holidayPackage->validaty_start = $data['validaty_start']?? $holidayPackage->validaty_start ;
        $holidayPackage->validaty_end = $data['validaty_end'] ??$holidayPackage->validaty_end;
        $holidayPackage->total_days = $data['total_days'] ?? $holidayPackage->total_days ;
        $holidayPackage->priority = $data['priority'] ?? $holidayPackage->priority ;
        $holidayPackage->country_id = $data['country_id'] ??$holidayPackage->country_id;
        $holidayPackage->city_id = $data['city_id'] ??  $holidayPackage->city_id ;
        $holidayPackage->description = $data['description'] ??$holidayPackage->description ;
        if (array_key_exists('thambnail_img', $data)){
            $this->deleteOne($holidayPackage->thambnail_img);
            $filename = $this->imageUpload($data['thambnail_img'], 400, 300, 'uploads/images/HolidayPackage/thambnail_img/', true);
            $holidayPackage->thambnail_img ='uploads/images/HolidayPackage/thambnail_img/'.$filename;
        }
        if (array_key_exists('slider_img', $data)){
            $images = json_decode($holidayPackage->slider_img, true);
            if ($images && is_array($images)) {
                foreach ($images as $img) {
                  $this->deleteOne($img);
                }
            }
            $images = [];
            foreach ($data['slider_img'] as $file_data) {
                //dd($file_data);
                $filename = $this->imageUpload($file_data, 500, 500, 'uploads/images/HolidayPackage/slider_img/', true);
                $images[] = 'uploads/images/HolidayPackage/slider_img/' . $filename;
            }
            $holidayPackage->slider_img = json_encode($images);
        }
        $holidayPackage->save();
        return $holidayPackage;
    }

    public function deleteHolidayPackage($id)
    {
        $holidayPackage= $this->holidayPackage->find($id);
        if($holidayPackage->thambnail_img){
            $this->deleteOne($holidayPackage->thambnail_img);
        }
        if($holidayPackage->slider_img){
            $images = json_decode($holidayPackage->slider_img, true);
            if ($images && is_array($images)) {
                foreach ($images as $img) {
                  $this->deleteOne($img);
                }
            }
        }
        $holidayPackage->delete();
    }
    public function statusHolidayPackage($id)
    {
        $holidayPackage= $this->holidayPackage->find($id);
        $holidayPackage->status = $holidayPackage->status == 1 ? 0 : 1;
        $holidayPackage->save();
        return $holidayPackage;
    }

}