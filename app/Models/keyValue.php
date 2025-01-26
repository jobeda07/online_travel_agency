<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keyValue extends Model
{
    use HasFactory;
    protected $table='key_values';

    public function translations()
    {
        return $this->hasMany(TranslateData::class, 'key', 'key');
    }
}
