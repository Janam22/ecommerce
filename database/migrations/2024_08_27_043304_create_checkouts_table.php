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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->bigInteger('cart_id')->index();
            $table->bigInteger('product_v_id')->index();
            $table->bigInteger('quantity');
            $table->decimal('rate', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('total', 10, 2)->nullable();
            $table->bigInteger('dpd_id')->index();
            $table->string('delivery_status')->default('processing');
            $table->timestamp('modify_date');
            $table->tinyInteger('display')->nullable()->default(1);
            $table->string('remarks')->nullable();
            $table->timestamps();
            
            // Defining the foreign key constraint
            $table->foreign('cart_id')
                  ->references('id')
                  ->on('cart')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
                  
            // Defining the foreign key constraint
            $table->foreign('product_v_id')
                ->references('id')
                ->on('productvarient')
                ->onDelete('restrict')
                ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
