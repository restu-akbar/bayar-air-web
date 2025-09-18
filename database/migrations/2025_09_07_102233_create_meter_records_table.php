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
        Schema::create('meter_records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id');
            $table->uuid('user_id');

            $table->integer('meter');
            $table->string('evidence');
            $table->string('receipt');
            $table->bigInteger('total_amount');
            $table->bigInteger('fine')->default(0);
            $table->bigInteger('duty_stamp')->default(0);
            $table->bigInteger('retribution_fee')->default(0);
            $table->string('status')->default("Belum bayar");
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_records');
    }
};
