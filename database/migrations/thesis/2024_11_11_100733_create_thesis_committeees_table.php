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
        Schema::create('thesis_committees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thesis_id');
            $table->string('lecturer_id'); // to table NU_DB.dbo.Personal
            $table->string('role'); // advisor, committee
            $table->string('title')->nullable(); // ងារ

            $table->foreign('thesis_id')->references('id')->on('thesises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_committees');
    }
};
