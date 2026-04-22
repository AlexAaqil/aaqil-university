<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses\Course;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                "title" => "Web Development",
                "description" => "Get acquinted with building websites and web applications from scratch.",
            ],
            [
                "title" => "Software Engineering",
                "description" => "Get acquinted with building complex systems and applications.",
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

        foreach($courses as $course) {
            Course::create([
                'title' => $course['title'],
                'description' => $course['description'],
            ]);
        }
    }
}
