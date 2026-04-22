<?php

namespace App\Livewire\Pages\General\Courses;

use Livewire\Component;
use App\Models\Courses\Course;

class Index extends Component
{
    public function render()
    {
        $courses = Course::query()
            ->withCount('specializations')
            ->orderBy('title')
            ->get();

        return view('livewire.pages.general.courses.index', compact('courses'))->layout('layouts.guest');
    }
}
