<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Modifiers;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subject', function (Blueprint $table) {
            $table->string('SubjectID')->primary();
            $table->string('SubjectName');
            $table->string('Category');
            $table->string('Description')->nullable();
            $table->integer('Credit');
            $table->string('Resources');
            $table->string('HomeworkPolicy');
            $table->string('ModifiedBy');
            $table->dateTime('ModifiedDate');
            $table->string('SubjectHour');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
