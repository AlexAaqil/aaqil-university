<?php

namespace App\Livewire\Pages\General\Courses;

use Livewire\Component;
use App\Models\Courses\Course;;

class Specializations extends Component
{
    public $course;
    public $specializations;

    public function mount($slug)
    {
        $this->course = Course::where('slug', $slug)->with('specializations')->firstOrFail();
        $this->specializations = $this->course->specializations;
    }

    public function render()
    {
        return view('livewire.pages.general.courses.specializations')->layout('layouts.guest');
    }
}
