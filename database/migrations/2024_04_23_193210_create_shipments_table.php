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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('donation_id');
            $table->foreign('donation_id')->references('id')->on('donations');
            $table->unsignedbiginteger('receiver_id');
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->unsignedbiginteger('dispatcher_id');
            $table->foreign('dispatcher_id')->references('id')->on('users');
            $table->text('dispatcher_location');
            $table->unsignedBigInteger('estimated_delivery_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
