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
        // Create the 'reviews' table
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->double('rating')->default(0); // Rating column with default value 0
            $table->string('comment')->nullable(); // Comment column, nullable
            $table->boolean('status')->default(false); // Status column with default value false
            $table->unsignedBigInteger('user_id'); // Foreign key column for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define foreign key constraint
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'reviews' table if it exists
        Schema::dropIfExists('reviews');
    }
};

