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
        Schema::create('productvarient', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->autoIncrement();
            $table->bigInteger('product_id')->index();
            $table->bigInteger('color_id')->index();
            $table->bigInteger('stock_in')->deafult(0);
            $table->bigInteger('stock_out')->default(0);
            $table->bigInteger('defective')->default(0);
            $table->bigInteger('returned')->default(0);
            $table->bigInteger('available')->nullable();
            $table->bigInteger('total')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            
            // Defining the foreign key constraint
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
                  
            // Defining the foreign key constraint
            $table->foreign('color_id')
                  ->references('id')
                  ->on('colors')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

        });
        
        // Add triggers
        DB::statement('
        CREATE TRIGGER update_available_before_insert
        BEFORE INSERT ON productvarient
        FOR EACH ROW
        SET NEW.available = NEW.stock_in - NEW.stock_out - NEW.defective + NEW.returned;
        ');

        DB::statement('
        CREATE TRIGGER update_available_before_update
        BEFORE UPDATE ON productvarient
        FOR EACH ROW
        SET NEW.available = NEW.stock_in - NEW.stock_out - NEW.defective + NEW.returned;
        ');

        // Trigger for total calculation
        DB::statement('
        CREATE TRIGGER update_total_before_insert
        BEFORE INSERT ON productvarient
        FOR EACH ROW
        SET NEW.total = NEW.available + NEW.defective + NEW.returned;
        ');

        DB::statement('
        CREATE TRIGGER update_total_before_update
        BEFORE UPDATE ON productvarient
        FOR EACH ROW
        SET NEW.total = NEW.available + NEW.defective + NEW.returned;
        ');
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productvarient');
    }
};
