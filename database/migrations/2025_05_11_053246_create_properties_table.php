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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->decimal('property_price', 10, 2);
            $table->enum('offer_type', ['sale', 'rent']);
            $table->text('property_address');
            $table->enum('property_status', ['pending', 'approved', 'declined'])->default('pending');
            $table->enum('property_type', ['apartment', 'house', 'land']);
            $table->enum('finish_status', ['finished', 'unfinished']);
            $table->text('property_description');
            $table->string('phone_number', 20);
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
