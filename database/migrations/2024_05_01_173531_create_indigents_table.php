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
        Schema::create('indigents', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('income');
            $table->bigInteger('expenditure');
            $table->unsignedbiginteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('indigents');
            $table->boolean('is_child');
            $table->enum('educational_status', ['illiterate', 'literate', 'primary', 'secondary', 'highschool', 'university', 'postgraduate', 'doctorate']);
            $table->unsignedbiginteger('aid_type');
            $table->foreign('aid_type')->references('id')->on('donation_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indigents');
    }
};
