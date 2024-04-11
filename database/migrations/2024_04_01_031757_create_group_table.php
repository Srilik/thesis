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
            $table->string('Promotion');
            $table->string('Year');
            $table->string('Semester');
            $table->string('Group');
            $table->string('AcademicYear');         
<<<<<<< HEAD
            $table->unique(['Department', 'MajorID', 'Promotion', 'Year', 'Semester', 'Group', 'AcademicYear']);
            // $table->unique(['Department', 'MajorID', 'Promotion']);

=======
            // $table->unique(['Department', 'MajorID', 'Promotion', 'Year', 'Semester', 'Group', 'AcademicYear']);
>>>>>>> c0af686d423d009776393f9817b694a558fc7f8b

            $table->string('ModifiedBy');
            $table->dateTime('ModifiedDate');
            $table->string('DMYS');
            $table->string('BatchByMajor');
            $table->string('GNo');
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
