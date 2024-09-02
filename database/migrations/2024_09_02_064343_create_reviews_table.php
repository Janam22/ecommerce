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
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->bigInteger('product_id')->index();
            $table->bigInteger('customer_id')->index();
            $table->string('user_name');
            $table->Integer('review_point');
            $table->text('review_message');
            $table->string('attachment')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            
            // Defining the foreign key constraint
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            
            // Defining the foreign key constraint
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
