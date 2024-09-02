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
        Schema::create('invoicerecord', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->string('refID')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('purchase_discount', 10, 2);
            $table->string('coupon_code')->nullable();
            $table->decimal('vat_amount', 10, 2);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('amt_receivable', 10, 2);
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
        Schema::dropIfExists('invoicerecord');
    }
};
