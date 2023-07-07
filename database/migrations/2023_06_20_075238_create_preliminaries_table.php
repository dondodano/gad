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
        Schema::create('preliminaries', function (Blueprint $table) {
            $table->id();
            $table->integer('sequence')->nullable();
            $table->integer('category_id')->nullable();
            $table->longText('pretext')->nullable();
            $table->longText('context')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preliminaries');
    }
};
