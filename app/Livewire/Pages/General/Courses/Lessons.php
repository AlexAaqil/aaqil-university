<?php

namespace App\Livewire\Pages\General\Courses;

use Livewire\Component;
use App\Models\Courses\Topic;
use App\Models\Courses\Specialization;

class Lessons extends Component
{
    public $topic;
    public $lessons;

    public function mount($course, $specialization, $topic)
    {
        $specialization = Specialization::where('slug', $specialization)
            ->whereHas('course', function ($q) use ($course) {
                $q->where('slug', $course);
            })
            ->firstOrFail();

        $this->topic = $specialization->topics()->where('slug', $topic)->with(['lessons' => function ($query) {
            $query->orderBy('sort_order');
        }])->firstOrFail();

        $this->lessons = $this->topic->lessons()->orderBy('sort_order')->get();
    }

    public function render()
    {
        return view('livewire.pages.general.courses.lessons')->layout('layouts.guest');
    }
}
