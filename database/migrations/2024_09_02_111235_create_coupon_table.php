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
        Schema::create('coupon', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->bigInteger('couponMaster_id')->nullable()->index();
            $table->string('coupon_code');
            $table->string('consumed_by')->nullable();
            $table->dateTime('consumed_date')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            
            // Defining the foreign key constraint
            $table->foreign('couponMaster_id')
                  ->references('id')
                  ->on('couponmaster')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon');
    }
};
