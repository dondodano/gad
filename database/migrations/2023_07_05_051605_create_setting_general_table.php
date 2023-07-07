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
        Schema::create('setting_general', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->mediumText('site_definition')->nullable();
            $table->string('entity_name')->nullable();
            $table->mediumText('entity_definition')->nullable();
            $table->string('web_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_general');
    }
};
