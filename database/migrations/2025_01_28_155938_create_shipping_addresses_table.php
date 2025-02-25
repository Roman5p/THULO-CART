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
        // Create the 'shipping_addresses' table
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('address'); // Address field
            $table->string('number'); // Number field
            $table->string('landmark')->nullable(); // Landmark field, nullable
            $table->integer('pincode'); // Pincode field
            $table->string('street_no')->nullable(); // Street number field, nullable
            $table->string('state'); // State field
            $table->boolean('is_permanent')->default(false); // Is permanent address, default false
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define foreign key constraint
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'shipping_addresses' table if it exists
        Schema::dropIfExists('shipping_addresses');
    }
};

