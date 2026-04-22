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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->unsignedInteger('sort_order')->nullable()->index();
            $table->boolean('is_locked')->default(false)->index(); // to help gate behind premium/progress

            $table->foreignId('specialization_id')->index()->constrained('specializations')->cascadeOnDelete();
            $table->unique(['specialization_id', 'title']);
            $table->unique(['specialization_id', 'slug']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
