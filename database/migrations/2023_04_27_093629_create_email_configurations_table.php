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
        Schema::create('email_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('host');
            $table->string('username');
            $table->string('password');
            $table->string('port');
            $table->string('encryption');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_configurations');
    }
};
