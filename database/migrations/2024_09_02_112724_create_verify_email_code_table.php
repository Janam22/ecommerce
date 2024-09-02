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
        Schema::create('verify_email_code', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->string('user_email');
            $table->string('verify_code');
            $table->tinyInteger('code_use')->nullable()->default(0);
            $table->dateTime('create_date')->nullable();
            $table->dateTime('use_date')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_email_code');
    }
};
