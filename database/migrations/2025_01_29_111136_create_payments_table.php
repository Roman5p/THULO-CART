<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new anonymous class that extends the Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is called when the migration is executed.
     */
    public function up(): void
    {
        // Create the 'payments' table
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('payment_method'); // Column to store the payment method
            $table->unsignedBigInteger('order_id'); // Foreign key to reference the orders table
            $table->enum('status', ['pending', 'failed', 'completed', 'refunded'])->default('pending'); // Column to store the payment status with default value 'pending'
            $table->string('transaction_id')->nullable(); // Column to store the transaction ID, can be null
            $table->timestamps(); // Columns to store created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     * This method is called when the migration is rolled back.
     */
    public function down(): void
    {
        // Drop the 'payments' table
        Schema::dropIfExists('payments');
    }
};
