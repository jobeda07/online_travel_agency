<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    use HasFactory;
    protected $table='account_ledgers';
    protected $guarded=[''];

    public function account_head(){
        return $this->belongsTo(AccountHead::class);
    }
}
