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
        Schema::create('paymentstatus', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->string('refID')->unique();
            $table->string('payment_received_mode');
            $table->string('transactionCode');
            $table->string('transactionAmount');
            $table->dateTime('transactionDate');
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
        Schema::dropIfExists('paymentstatus');
    }
};
