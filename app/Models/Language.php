<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table='languages';

     public function translations()
    {
        return $this->hasMany(TranslateData::class, 'lang_code', 'lang_code');
    }
}
