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
            $table->foreign('donor_id')->references('id')->on('users')->onDelete(null);
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('donation_types')->onDelete('cascade');
            $table->unsignedBigInteger('amount');
            $table->enum('approval', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->enum('delivery_type', ['to-us', 'by-us']);
            $table->boolean('collected')->default(false);
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->nullOnDelete();
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->foreign('shipment_id')->references('id')->on('shipments')->nullOnDelete();
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
