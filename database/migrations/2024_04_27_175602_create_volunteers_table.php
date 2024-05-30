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
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->text('profession');
            $table->unsignedbiginteger('income');
            $table->unsignedbiginteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('areas')->nullOnDelete();
            $table->boolean('transportation');
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
