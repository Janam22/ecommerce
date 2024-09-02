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
        Schema::create('deliverydetails', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->string('refID')->unique();
            $table->string('courierName');
            $table->string('consignmentNo');
            $table->dateTime('consignmentDate');
            $table->string('contactPerson');
            $table->string('mobileNo');
            $table->string('remarks')->nullable();
            $table->timestamps();
            
            // Defining the foreign key constraint
            $table->foreign('refID')
                  ->references('reference_no')
                  ->on('delivery_payment_details')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliverydetails');
    }
};
