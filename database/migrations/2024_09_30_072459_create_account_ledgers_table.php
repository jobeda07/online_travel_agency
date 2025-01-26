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
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_head_id');
            $table->string('particulars', 255);
            $table->unsignedTinyInteger('account_type')->default(0)->comment('1=>Debit, 2=>Credit');
            $table->double('debit')->default(0.00);
            $table->double('credit')->default(0.00);
            $table->double('balance')->default(0.00);
            $table->bigInteger('ticket_id')->default(0);
            $table->unsignedTinyInteger('ticket_type')->default(0)->comment('1=>airTicket, 2=>hotelTicket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_ledgers');
    }
};
