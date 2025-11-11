<?php

namespace App\Livewire\Pages\General\Courses;

use Livewire\Component;
use App\Models\Courses\Course;

class Specializations extends Component
{
    public $course;

    public function mount($course)
    {
        $this->course = Course::where('slug', $course)->firstOrFail();
    }

    public function getSpecializationsProperty()
    {
        return $this->course
            ->specializations()
            ->withCount('topics')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.general.courses.specializations', ['specializations' => $this->specializations])->layout('layouts.guest');
    }
}
