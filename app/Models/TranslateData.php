<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslateData extends Model
{
    use HasFactory;
    protected $table='translate_data';
    protected $guarded=[''];
    public function keyValue()
    {
        return $this->belongsTo(KeyValue::class, 'key', 'key');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_code', 'lang_code');
    }
}
