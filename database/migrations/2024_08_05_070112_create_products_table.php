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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable();
            $table->string('product_name');
            $table->string('category_id');
            $table->string('specification')->nullable();
            $table->decimal('actual_price', 8, 2);
            $table->decimal('sell_price', 8, 2);
            $table->decimal('retailer_price', 8, 2);
            $table->decimal('wholesaler_price', 8, 2);
            $table->decimal('dealer_price', 8, 2);
            $table->string('img_path');
            $table->binary('primary_image');
            $table->binary('secondary_image');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
