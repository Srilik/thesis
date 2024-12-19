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
        Schema::create('student_group', function (Blueprint $table) {
            $table->id();
            $table->string('group_id');
            $table->string('student_id');
            $table->string('academic_year')->nullable();
            $table->tinyInteger('semester')->nullable();
            $table->uuid('semester_id')->nullable();
            $table->tinyInteger('is_acc_ok')->default(1);
            $table->dateTime('acc_date')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_group');
    }
};
