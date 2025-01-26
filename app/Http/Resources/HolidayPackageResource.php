<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\CategoryResource;
use Carbon\Carbon;
use Log;


class HolidayPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $langCode = getLangCode();
        $translations = $this->DynamicTranslations->where('lang_code', $langCode)->pluck('value', 'key_name');
        return [
            "id" => $this->id,
            "title" => $translations['title'] ?? $this->title,
            "slug" => $this->slug ?? '',
            "price" => $this->price ?? '',
             'location' => [
                'country' => $this->country ? new CountryResource($this->country) : null,
                'city' => $this->city ? new CityResource($this->city) : null,
            ],
            "validaty_start" => $this->validaty_start ? Carbon::parse($this->validaty_start)->toFormattedDateString() : '',
            "validaty_end" => $this->validaty_end ? Carbon::parse($this->validaty_end)->toFormattedDateString() : '',
            "total_days" => $this->total_days ?? '',
            "description" =>  $translations['description'] ?? $this->description,
            "thambnail_img" => $this->thambnail_img ? env('APP_URL') . "/" . $this->thambnail_img : '',
            "slider_img" => $this->slider_img ? array_map(function($image) {
                return env('APP_URL') . "/" . $image;
            }, json_decode($this->slider_img, true)) : [],
        ];
    }
}
