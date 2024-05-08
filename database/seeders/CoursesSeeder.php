<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Str;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "title" => "Web Development",
                "description" => "Get acquinted with building websites and web applications from scratch.",
            ],
            [
                "title" => "Software Engineering",
                "description" => "Get acquinted with building complex systems applications.",
            ],
            [
                "title" => "Graphic Design",
                "description" => "Design the best and most user friendly visuals.",
            ],
            [
                "title" => "Video Editing",
                "description" => "Create content that captures, educates and entertains.",
            ],
        ];

        foreach($categories as $category) {
            Course::create([
                'title' => $category['title'],
                'slug' => Str::slug($category['title']),
                'description' => $category['description'],
            ]);
        }
    }
}
