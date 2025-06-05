<?php

namespace App\Livewire\Pages\General\Courses;

use Livewire\Component;
use App\Models\Topic;

class Lessons extends Component
{
    public $topic;
    public $lessons;

    public function mount($topic)
    {
        $this->topic = Topic::where('slug', $topic)->with(['lessons' => function($query) {
            $query->orderBy('ordering');
        }])->firstOrFail();;
        $this->lessons = $this->topic->lessons()->orderBy('ordering')->get();
    }

    public function render()
    {
        return view('livewire.pages.general.courses.lessons')->layout('layouts.guest');
    }
}
