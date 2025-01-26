<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayPackage extends Model
{
    use HasFactory;
    protected $table = 'holiday_packages';
    protected $guarded = [];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function DynamicTranslations()
    {
        return $this->hasMany(DynamicTranslate::class, 'key_id', 'id')
                    ->where('model_name', self::class);
    }

}
