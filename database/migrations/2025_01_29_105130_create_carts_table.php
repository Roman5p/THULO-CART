<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new anonymous class that extends the Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is used to create the 'carts' table.
     */
    public function up(): void
    {
        // Create the 'carts' table
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Primary key column
            $table->unsignedBigInteger('user_id'); // Foreign key column for user
            $table->unsignedBigInteger('product_id'); // Foreign key column for product
            $table->integer('quantity')->default(0); // Quantity column with default value 0
            // Define foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Define foreign key constraint for product_id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps(); // Timestamps columns (created_at and updated_at)
        });
    }

    /**
     * Reverse the migrations.
     * This method is used to drop the 'carts' table.
     */
    public function down(): void
    {
        // Drop the 'carts' table if it exists
        Schema::dropIfExists('carts');
    }
};
