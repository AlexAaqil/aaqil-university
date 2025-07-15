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
            $table->uuid('uuid')->unique();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true)->index;
            $table->unsignedTinyInteger('difficulty_level')->nullable()->index();
            $table->unsignedSmallInteger('estimated_duration_minutes')->nullable();
            $table->string('intro_video_url')->nullable();
            $table->json('tags')->nullable(); // to make the content searchable such as python, frontend.

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->index();
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
