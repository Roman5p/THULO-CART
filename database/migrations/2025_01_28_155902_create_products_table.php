<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new anonymous class that extends the Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is used to create the 'products' table.
     */
    public function up(): void
    {
        // Create the 'products' table
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('slug')->unique(); // Unique slug for the product
            $table->string('name'); // Name of the product
            $table->double('price')->default(0.0); // Price of the product with a default value of 0.0
            $table->integer('quantity')->default(0); // Quantity of the product with a default value of 0
            $table->double('discount_amount')->default(0.0); // Discount amount with a default value of 0.0
            $table->double('actual_amount')->default(0.0); // Actual amount with a default value of 0.0
            $table->string('image')->nullable(); // Image URL, nullable
            $table->longText('description')->nullable(); // Description of the product, nullable
            $table->boolean('is_feature')->default(false); // Boolean to check if the product is featured, default is false
            $table->boolean('is_selling')->default(false); // Boolean to check if the product is selling, default is false
            $table->boolean('is_popular')->default(false); // Boolean to check if the product is popular, default is false
            $table->boolean('is_new')->default(false); // Boolean to check if the product is new, default is false
            $table->unsignedBigInteger('category_id'); // Foreign key for the category
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Define foreign key constraint
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     * This method is used to drop the 'products' table.
     */
    public function down(): void
    {
        // Drop the 'products' table
        Schema::dropIfExists('products');
    }
};
