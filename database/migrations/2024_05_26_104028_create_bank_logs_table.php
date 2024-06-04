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
        Schema::create('bank_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id')->nullable()->default(null);
            $table->foreign('donation_id')->references('id')->on('donations');
            $table->unsignedBigInteger('shipment_id')->nullable()->default(null);
            $table->foreign('shipment_id')->references('id')->on('shipments');
            $table->unsignedBigInteger('amount');
            $table->integer('balance')->default(0);
            $table->enum('type', ['incoming', 'outgoing']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_logs');
    }
};
