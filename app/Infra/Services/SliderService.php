<?php

namespace App\Infra\Services;

use App\Infra\Repositories\SliderRepository;

class SliderService
{
    private SliderRepository $SliderRepository;
    /**
     * @param SliderRepository $SliderRepository
     */
    public function __construct(
        SliderRepository $SliderRepository,
    ) {
        $this->sliderRepository = $SliderRepository;
    }

    public function allSliderGet()
    {
        $countries = $this->sliderRepository->allSliderGet();
        return $countries;
    }
    public function storeSlider(array $data)
    {
        return $this->sliderRepository->storeSlider($data);
    }
    public function findSliderById($id)
    {
        return $this->sliderRepository->findSliderById($id);
    }

    public function updateSlider($id, array $data)
    {
        return $this->sliderRepository->updateSlider($id, $data);
    }
    public function deleteSlider($id)
    {
        return $this->sliderRepository->deleteSlider($id);
    }
    public function statusSlider($id)
    {
        return $this->sliderRepository->statusSlider($id);
    }
}
