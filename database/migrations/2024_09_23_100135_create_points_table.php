<?php

use App\Models\Customer;
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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class);
            $table->integer('amount');
            $table->date('validity');
            $table->integer('used_amount');
            $table->integer('booking_id');
            $table->integer('booking_type')->comment('1=air ticket,2=hotel ticket');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * user_id
booking_id
amount (int)
validity (date)
status
used_amount (int)
booking_type (airticket hole 1, hotel hole 2)
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
