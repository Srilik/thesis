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
        Schema::create('group_thesis', function (Blueprint $table) {
            $table->id('group_id'); // Auto-increment ID
            $table->string('group_name'); // Group Name
            $table->timestamps(); // Created and Updated timestamps           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_theses');
    }
};
