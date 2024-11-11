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
        Schema::create('thesises', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('group_id');
            $table->string('academic_year');
            $table->string('major');
            $table->tinyInteger('year');
            $table->integer('batch');
            $table->text('topic')->nullable();
            $table->text('topic_kh')->nullable();
            $table->longText('objective')->nullable();
            $table->longText('objective_kh')->nullable();
            $table->longText('description')->nullable();
            $table->string('organization')->nullable();
            $table->string('organization_type')->nullable();
            $table->text('organization_address')->nullable();
            $table->string('organization_phone')->nullable();
            $table->string('organization_email')->nullable();
            $table->string('lecturer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesises');
    }
};
