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
        Schema::create('log_user', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->longText('agent')->nullable();
            $table->integer('log_state')->default(1);
            $table->dateTime('log_date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_user');
    }
};
