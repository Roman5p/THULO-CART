<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new anonymous class that extends the Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is used to create the 'order_items' table.
     */
    public function up(): void
    {
        // Create the 'order_items' table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('order_id'); // Foreign key to 'orders' table
            $table->unsignedBigInteger('product_id'); // Foreign key to 'products' table
            $table->integer('quantity'); // Quantity of the product in the order

            // Define foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Alternative way to define foreign key constraints
            // $table->foreignId('order_id')->constrained();
            // $table->foreignId('product_id')->constrained();

            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     * This method is used to drop the 'order_items' table.
     */
    public function down(): void
    {
        // Drop the 'order_items' table if it exists
        Schema::dropIfExists('order_items');
    }
};
