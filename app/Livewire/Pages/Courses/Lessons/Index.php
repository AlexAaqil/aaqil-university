<?php

namespace App\Livewire\Pages\Courses\Lessons;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Courses\Topic;
use App\Models\Courses\Lesson;

class Index extends Component
{
    use WithPagination;

    public $topic;

    public $confirm_lesson_deletion = false;
    public ?int $delete_lesson_id = null;

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

    public function mount($topic)
    {
        $this->topic = Topic::where('slug', $topic)
            ->withCount('lessons')
            ->firstOrFail();
    }

    public function getLessonsProperty()
    {
        return $this->topic
            ->lessons()
            ->withCount('sections')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('title')
            ->paginate(12)
            ->withQueryString();
    }

    protected $listeners = [
        'confirm-lesson-deletion' => 'confirmLessonDeletion',
        'lesson-deleted' => '$refresh',
    ];

    public function confirmLessonDeletion($lessonId)
    {
        $this->delete_lesson_id = $lessonId;
        $this->confirm_lesson_deletion = true;
    }

    public function deleteLesson()
    {
        if ($this->delete_lesson_id) {
            Lesson::destroy($this->delete_lesson_id);
            $this->delete_lesson_id = null;
            $this->confirm_lesson_deletion = false;
        }
    }

    public function render()
    {
        $lessons = $this->getLessonsProperty();

        return view('livewire.pages.courses.lessons.index', compact('lessons'));
    }
}
