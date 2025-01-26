<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 100);
            $table->string('name_bn', 100);
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('country_id');
            // $table->foreign('country_id')
            //     ->references('id')
            //     ->on('countries')
            //     ->onDelete('cascade');
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
