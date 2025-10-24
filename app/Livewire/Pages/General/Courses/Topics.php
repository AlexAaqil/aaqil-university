<?php

namespace App\Livewire\Pages\General\Courses;

use Livewire\Component;
use App\Models\Courses\Specialization;

class Topics extends Component
{
    public $specialization;

    public function mount($course, $specialization)
    {
        $this->specialization = Specialization::where('slug', $specialization)
            ->whereHas('course', function ($query) use ($course) {
                $query->where('slug', $course);
            })
            ->with(['course', 'topics' => function ($query) {
                $query->orderBy('title');
            }])
            ->withCount('topics')
            ->firstOrFail();
    }

    public function getTopicsProperty()
    {
        return $this->specialization
            ->topics()
            ->withCount('lessons')
            ->orderBy('title')
            ->paginate(12)
            ->withQueryString();
    }

    public function render()
    {
        return view('livewire.pages.general.courses.topics', ['topics' => $this->topics])->layout('layouts.guest');
    }
}
