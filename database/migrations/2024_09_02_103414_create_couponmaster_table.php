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
        Schema::create('couponmaster', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->string('coupon_name');
            $table->decimal('coupon_value', 10, 2);
            $table->string('coupon_value_type');
            $table->string('coupon_description');
            $table->string('coupon_use_type');
            $table->dateTime('coupon_create_date')->useCurrent();
            $table->dateTime('coupon_start_date');
            $table->dateTime('coupon_expire_date');
            $table->bigInteger('generated_coupon_count');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couponmaster');
    }
};
