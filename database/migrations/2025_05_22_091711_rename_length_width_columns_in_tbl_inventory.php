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
        Schema::table('tbl_inventory', function (Blueprint $table) {
            //
            $table->renameColumn('length_cm', 'length');
            $table->renameColumn('width_cm', 'width');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_inventory', function (Blueprint $table) {
            //
             $table->renameColumn('length', 'length_cm');
            $table->renameColumn('width', 'width_cm');
        });
    }
};
