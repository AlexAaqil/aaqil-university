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
        Schema::create('course_specialization', function (Blueprint $table) {
            $table->foreignId('course_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('specialization_id')->index()->constrained()->onDelete('cascade');
            $table->unsignedSmallInteger('ordering')->default(500);

            // Add a unique constraint to ensure a course cannot have duplicate specializations
            $table->unique(['course_id', 'specialization_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_specialization');
    }
};
