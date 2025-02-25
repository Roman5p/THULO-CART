<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new anonymous class that extends the Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is used to create the 'orders' table.
     */
    public function up(): void
    {
        // Create the 'orders' table
        Schema::create('orders', function (Blueprint $table) {
            // Add an auto-incrementing primary key column
            $table->id();
            // Add an unsigned big integer column for the user ID
            $table->unsignedBigInteger('user_id');
            // Add an enum column for the order status with default value 'pending'
            $table->enum('status', ['pending', 'shipped', 'delivered', 'canceled'])->default('pending');
            // Add a double column for the total cost with default value 0.0
            $table->double('total_cost')->default(0.0);
            // Add an integer column for the total quantity with default value 0
            $table->integer('total_quantity')->default(0);
            // Add a foreign key constraint on the user_id column referencing the id column on the users table
            // with cascade on delete
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Add created_at and updated_at timestamp columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * This method is used to drop the 'orders' table.
     */
    public function down(): void
    {
        // Drop the 'orders' table
        Schema::dropIfExists('orders');
    }
};
