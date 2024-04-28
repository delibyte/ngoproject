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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('profession');
            $table->bigInteger('income');
            $table->unsignedbiginteger('region_id');
            $table->foreign('region_id')->references('id')->on('areas');
            $table->boolean('transportation');
            // TODO: Availability Information
            $table->enum('status', ['pending', 'active', 'revoked']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
