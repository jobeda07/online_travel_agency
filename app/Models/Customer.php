<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory,Notifiable ,HasApiTokens;
    protected $table = 'customers';
    protected $guarded = [];

    public function points()
    {
        return $this->hasMany(Point::class, 'customer_id');
    }

    public function getUsablePoints()
    {
        return $this->points()
            ->where('validity', '>=', now())
            ->sum('used_amount');
    }
}
