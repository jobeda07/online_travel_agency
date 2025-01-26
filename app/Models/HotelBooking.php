<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\RoomTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use HasFactory;
    protected $table='hotel_bookings';
    protected $casts=[
        'payment_method'=>PaymentMethodEnum::class,
        'room_type'=>RoomTypeEnum::class,
    ];
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
