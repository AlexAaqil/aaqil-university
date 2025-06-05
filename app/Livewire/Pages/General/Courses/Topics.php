<?php

namespace App\Livewire\Pages\General\Courses;

use Livewire\Component;
use App\Models\Specialization;

class Topics extends Component
{
    public $specialization;
    public $topics;

    public function mount($specialization)
    {
        $this->specialization = Specialization::where('slug', $specialization)->with('topics')->firstOrFail();
        $this->topics = $this->specialization->topics;
    }

    public function render()
    {
        return view('livewire.pages.general.courses.topics')->layout('layouts.guest');
    }
}
