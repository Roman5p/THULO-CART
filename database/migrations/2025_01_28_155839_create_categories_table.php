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
        // Create the 'categories' table
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Add an auto-incrementing primary key column
            $table->string('slug')->unique(); 
            $table->string('name'); // Add a string column for the category name
            $table->string('image')->nullable();
            $table->longText('description')->nullable(); // Add a long text column for the category description
            $table->timestamps(); // Add timestamp columns for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     * This method is called when the migration is rolled back.
     */
    public function down(): void
    {
        // Drop the 'categories' table if it exists
        Schema::dropIfExists('categories');
    }
};
