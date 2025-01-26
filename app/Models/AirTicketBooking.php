<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AirTicketBooking extends Model
{
    use HasFactory;
    protected $table='air_ticket_bookings';
    
    protected $casts=[
        'payment_method'=>PaymentMethodEnum::class,
    ];
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
