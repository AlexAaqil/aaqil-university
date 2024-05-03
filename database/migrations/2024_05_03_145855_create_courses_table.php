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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug');
            $table->string('short_description', 255);
            $table->text('long_description')->nullable();
            $table->decimal('price', 10, 2)->default('0.00');
            $table->unsignedTinyInteger('duration_in_months')->nullable();
            $table->unsignedTinyInteger('ordering')->default(200);

            $table->foreignId('course_category_id')->nullable()->constrained('course_categories')->onDelete('set null')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
