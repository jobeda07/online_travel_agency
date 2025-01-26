<?php

namespace App\Infra\Services;

use App\Infra\Repositories\HolidayPackageRepository;

class HolidayPackageService{

    private HolidayPackageRepository $holidayPackageRepository; 
    
    public function __construct(HolidayPackageRepository $holidayPackageRepository){
         $this->holidayPackageRepository=$holidayPackageRepository;
    }
    public function allHolidayPackageGet(){
        $holidayPackages= $this->holidayPackageRepository->allHolidayPackageGet();
        return  $holidayPackages;
    }
    public function storeHolidayPackage(Array $data){
          return $this->holidayPackageRepository->storeHolidayPackage($data);
    }
    public function findHolidayPackageById($id)
    {
        return $this->holidayPackageRepository->findHolidayPackageById($id);
    }
    public function updateHolidayPackage($id, array $data)
    {
        return $this->holidayPackageRepository->updateHolidayPackage($id, $data);
    }
    public function deleteHolidayPackage($id)
    {
        return $this->holidayPackageRepository->deleteHolidayPackage($id);
    }
    public function statusHolidayPackage($id)
    {
        return $this->holidayPackageRepository->statusHolidayPackage($id);
    }


}