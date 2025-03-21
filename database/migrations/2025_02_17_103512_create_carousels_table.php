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
        // Create the 'carousels' table
        Schema::create('carousels', function (Blueprint $table) {
            $table->id(); // Add an auto-incrementing primary key column
            $table->string(column: 'image')->nullable(); // Add a nullable string column for the image
            $table->timestamps(); // Add created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     * This method is called when the migration is rolled back.
     */
    public function down(): void
    {
        // Drop the 'carousels' table if it exists
        Schema::dropIfExists('carousels');
    }
};
