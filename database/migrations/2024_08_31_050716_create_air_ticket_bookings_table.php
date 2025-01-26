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
        Schema::create('air_ticket_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code');
            $table->string('ticket_code');
            $table->string('airline_code');
            $table->unsignedBigInteger('customer_id');
            $table->string('pnr');
            $table->string('travel_date');
            $table->string('return_date')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->tinyInteger('way_type')->default(1);
            $table->bigInteger('no_of_adult')->nullable();
            $table->bigInteger('no_of_child')->nullable();
            $table->double('adult_base_price')->nullable();
            $table->double('child_base_price')->nullable();
            $table->double('total_price')->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('point_discount')->default(0);
            $table->double('vat')->nullable();
            $table->double('extra_charge')->nullable();
            $table->text('extra_charge_details')->nullable();
            $table->double('grand_total')->nullable();
            $table->double('paid_amount')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('payment_status')->default(0);
            $table->string('payment_method')->nullable();
            $table->text('payment_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_ticket_bookings');
    }
};
