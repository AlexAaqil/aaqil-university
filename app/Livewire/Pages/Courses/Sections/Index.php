<?php

namespace App\Livewire\Pages\Courses\Sections;

use Livewire\Component;
use App\Models\Courses\Lesson;
use App\Models\Courses\Section;

class Index extends Component
{
    public $lesson;

    public $confirm_section_deletion = false;
    public ?int $delete_section_id = null;

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

    public function mount($lesson)
    {
        $this->lesson = Lesson::where('slug', $lesson)
            ->withCount('sections')
            ->firstOrFail();
    }

    public function getSectionsProperty()
    {
        return $this->lesson
            ->sections()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('title')
            ->get();
    }

    protected $listeners = [
        'confirm-section-deletion' => 'confirmSectionDeletion',
        'section-deleted' => '$refresh',
    ];

    public function confirmSectionDeletion($sectionId)
    {
        $this->delete_section_id = $sectionId;
        $this->confirm_section_deletion = true;
    }

    public function deleteSection()
    {
        if ($this->delete_section_id) {
            $section = Section::find($this->delete_section_id);

            if ($section) {
                $section->delete();
                $this->dispatch('section-deleted');
            }

            $this->reset(['confirm_section_deletion', 'delete_section_id']);
        }
    }

    public function render()
    {
        $sections = $this->sections;

        return view('livewire.pages.courses.sections.index', compact('sections'));
    }
}
