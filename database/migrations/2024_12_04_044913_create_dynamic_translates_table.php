<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('dynamic_translates', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('lang_code');
            $table->string('key_id');
            $table->string('key_name');
            $table->longtext('value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_translates');
    }
};
