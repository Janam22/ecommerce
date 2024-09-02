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
        Schema::create('deliveryconfirmed', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->string('refID');
            $table->string('cartId');
            $table->string('confirm_by');
            $table->dateTime('confirmdate');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveryconfirmed');
    }
};
