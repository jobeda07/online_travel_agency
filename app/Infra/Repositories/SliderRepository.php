<?php

namespace App\Infra\Repositories;

use App\Models\Slider;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Storage;


class SliderRepository
{
    use ImageUpload;
    private Slider $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function allSliderGet()
    {
        $countries = $this->slider->get();
        return $countries;
    }
    public function storeSlider(array $data)
    {
        $slider = new Slider();
        $slider->title = $data['title'];
        $slider->status =1;
        if (array_key_exists('image', $data)){
            $filename = $this->imageUpload($data['image'], 1920, 600, 'uploads/images/Slider/', true);
            $slider->image ='uploads/images/Slider/'.$filename;
        }
        if(array_key_exists('video', $data)){
            $video = time() . '.' . $data['video']->getclientOriginalExtension();
            $data['video']->move(public_path('uploads/images/Slider/'), $video);
            $slider->video = "uploads/images/Slider/".$video;
        }

        $slider->save();
        return $slider;
    }

    public function findSliderById($id)
    {
        return $this->slider->findOrFail($id);
    }

    public function updateSlider($id, array $data)
    {
        $slider = $this->findSliderById($id);
        $slider->title = $data['title'];
        $slider->status =$slider->status;
        if (array_key_exists('image', $data)){
            $this->deleteOne($slider->image);
            $this->deleteOne($slider->video);
            $slider->video ='';
            $filename = $this->imageUpload($data['image'], 1920, 1080, 'uploads/images/Slider/', true);
            $slider->image ='uploads/images/Slider/'.$filename;
        }else{
            $slider->image=$slider->image ?? '';
        }
        if(array_key_exists('video', $data)){
            $this->deleteOne($slider->video);
            $this->deleteOne($slider->image);
            $slider->image ='';
            $video = time() . '.' . $data['video']->getclientOriginalExtension();
            $data['video']->move(public_path('uploads/images/Slider/'), $video);
            $slider->video = "uploads/images/Slider/".$video;
        }else{
            $slider->video=$slider->video ?? '';
        }
        $slider->save();
        return $slider;
    }
    public function deleteSlider( $id)
    {
        $slider = $this->slider->find($id);
        if ($slider) {
            $this->deleteOne($slider->image);
            $this->deleteOne($slider->video);
            return $slider->delete();
        }
    }
    public function statusSlider( $id)
    {
        $slider = $this->slider->find($id);
        $slider->status = $slider->status == 1 ? 0 : 1;
        $slider->save();
        return $slider;
    }
}
