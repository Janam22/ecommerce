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
        Schema::create('vendor_users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('active_state')->nullable();
            $table->string('user_type');
            $table->string('vendor_company_name');
            $table->string('vendor_email')->unique();
            $table->string('vendor_password');
            $table->string('vendor_contact');
            $table->string('vendor_pan')->nullable();
            $table->string('vendor_vat')->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('vendor_address');
            $table->string('remarks')->nullable();
            $table->dateTime('deactivated_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_users');
    }
};
