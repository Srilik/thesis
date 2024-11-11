<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('thesis_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thesis_id');
            $table->string('student_id'); // to table NU_DB.dbo.Students
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('remark')->nullable();

            $table->foreign('thesis_id')->references('id')->on('thesises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_students');
    }
};
