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
        Schema::create('group', function (Blueprint $table) {
            $table->id();

            $table->string('Department');
            $table->string('MajorID');
            $table->integer('Promotion');
            $table->integer('Year');
            $table->string('Semester');
            $table->string('Group');
            $table->string('AcademicYear');         
            // $table->unique(['Department', 'MajorID', 'Promotion', 'Year', 'Semester', 'Group', 'AcademicYear']);

            $table->string('ModifiedBy');
            $table->dateTime('ModifiedDate');
            $table->string('DMYS');
            $table->string('BatchByMajor');
            $table->string('BNo');
            $table->string('MaxSeats');
            $table->string('Shift');
            $table->string('MaxSeat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group');
    }
};
