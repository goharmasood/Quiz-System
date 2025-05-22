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
        Schema::create('tbl_inventory', function (Blueprint $table) {
        $table->id(); // Auto-incrementing ID
        $table->unsignedBigInteger('type_id'); // Foreign key to another table (optional)
        $table->string('name');
        $table->decimal('length', 8, 2)->nullable();
        $table->decimal('width', 8, 2)->nullable();
        $table->decimal('actual_price', 10, 2);
        $table->decimal('sell_price', 10, 2);
        $table->decimal('discount_price', 10, 2)->nullable();
        $table->integer('total_stock')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_inventory');
    }
};
