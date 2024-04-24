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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');
            $table->foreign('donor_id')->references('id')->on('users');
            $table->enum('type', ['cash', 'food', 'furniture', 'clothing']);
            $table->unsignedBigInteger('amount');
            $table->enum('approval', ['accepted', 'rejected']);
            $table->enum('delivery_type', ['to-us', 'by-us']);
            $table->boolean('collected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
