<?php

namespace App\Livewire\Pages\Courses\Specializations;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Courses\Course;
use App\Models\Courses\Specialization;

class Index extends Component
{
    use WithPagination;

    public $course;

    public $confirm_course_deletion = false;
    public ?int $delete_specialization_id = null;

    public string $search = '';
    public bool $search_performed = false;

     // Include search in URL query string
    protected $queryString = ['search'];

    // Reset page when search input changes
    public function performSearch()
    {
        $this->search_performed = true;
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->search_performed = false;
        $this->resetPage();
    }

    public function mount($course)
    {
        $this->course = Course::where('slug', $course)
            ->withCount('specializations')
            ->firstOrFail();
    }

    public function getSpecializationsProperty()
    {
        return $this->course
            ->specializations()
            ->withCount('topics')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('title')
            ->paginate(12)
            ->withQueryString();
    }

    protected $listeners = [
        'confirm-specialization-deletion' => 'confirmSpecializationDeletion',
    ];

    public function confirmSpecializationDeletion($data)
    {
        $this->delete_specialization_id = $data['specialization_id'];
        $this->dispatch('open-modal', 'confirm-specialization-deletion');
    }

    public function deleteCourse()
    {
        if ($this->delete_specialization_id) {
            $specialization = Specialization::findOrFail($this->delete_specialization_id);
            $specialization->delete();

            $this->delete_specialization_id = null;
            $this->dispatch('close-modal', 'confirm-specialization-deletion');
            $this->dispatch('notify', type: 'success', message: 'specialization deleted successfully');
        }
    }

    public function render()
    {
        $specializations = $this->specializations;

        return view('livewire.pages.courses.specializations.index', compact('specializations'));
    }
}
