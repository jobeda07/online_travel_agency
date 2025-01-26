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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->uniqid();
            $table->string('phone', 20)->uniqid();
            $table->string('username', 40)->uniqid();
            $table->string('password');
            $table->text('address');
            $table->string('post_code');
            $table->date('dob');
            $table->string('gender');
            $table->string('national_id');
            $table->string('passport_number');
            $table->date('passport_expire_date');
            $table->timestamps();
        });
    }
                                     

    /**
     * Reverse the migrations.                                
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
