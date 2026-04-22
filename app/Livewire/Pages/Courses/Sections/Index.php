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

    public function mount($course, $specialization, $topic, $lesson)
    {
        // The route may provide either a lesson slug string or a bound Lesson model.
        // Handle both cases and always scope/verify the lesson belongs to the
        // requested topic/specialization/course to avoid collisions across
        // specializations with identical slugs.
        if ($lesson instanceof Lesson) {
            // Ensure the mounted Lesson belongs to the supplied parents.
            $lesson->load(['topic.specialization.course']);

            $matches = (
                $lesson->topic->slug === $topic &&
                $lesson->topic->specialization->slug === $specialization &&
                $lesson->topic->specialization->course->slug === $course
            );

            if (! $matches) {
                // If the bound lesson doesn't match the requested parents, try to
                // find the correct lesson by slug scoped to the parents.
                $this->lesson = Lesson::where('slug', $lesson->slug)
                    ->whereHas('topic', function ($q) use ($topic, $specialization, $course) {
                        $q->where('slug', $topic)
                          ->whereHas('specialization', function ($q2) use ($specialization, $course) {
                              $q2->where('slug', $specialization)
                                 ->whereHas('course', function ($q3) use ($course) {
                                     $q3->where('slug', $course);
                                 });
                          });
                    })
                    ->withCount('sections')
                    ->firstOrFail();
            } else {
                $this->lesson = $lesson->loadCount('sections');
            }
        } else {
            // Scope the lesson lookup to the given topic/specialization/course so that
            // lessons with identical slugs in other specializations do not collide.
            $this->lesson = Lesson::where('slug', $lesson)
                ->whereHas('topic', function ($q) use ($topic, $specialization, $course) {
                    $q->where('slug', $topic)
                      ->whereHas('specialization', function ($q2) use ($specialization, $course) {
                          $q2->where('slug', $specialization)
                             ->whereHas('course', function ($q3) use ($course) {
                                 $q3->where('slug', $course);
                             });
                      });
                })
                ->withCount('sections')
                ->firstOrFail();
        }
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
