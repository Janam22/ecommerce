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
        Schema::create('delivery_payment_details', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->string('full_name');
            $table->string('province');
            $table->string('district');
            $table->string('municipality');
            $table->string('tole');
            $table->string('phone');
            $table->string('checkouts_email');
            $table->bigInteger('cart_id')->index();
            $table->string('payment_mode');
            $table->string('payment_status');
            $table->string('delivery_status')->default('processing');
            $table->dateTime('dispatch_date')->nullable();
            $table->string('delivered_by')->default('No one');
            $table->dateTime('delivered_on')->nullable();
            $table->string('reference_no')->unique();
            $table->dateTime('modify_date')->useCurrent();
            $table->string('remarks')->nullable();
            $table->timestamps();
            
            // Defining the foreign key constraint
            $table->foreign('cart_id')
                  ->references('id')
                  ->on('cart')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_payment_details');
    }
};
