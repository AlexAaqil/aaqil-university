<?php

namespace App\Livewire\Pages\Courses\Courses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Courses\Course;

class Index extends Component
{
    use WithPagination;

    public $confirm_course_deletion = false;
    public ?int $delete_course_id = null;

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

    public function togglePublished($course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->is_published = !$course->is_published;
        $course->save();

        $this->dispatch('notify', type: 'success', message: 'status updated successfully');
    }

    protected $listeners = [
        'confirm-course-deletion' => 'confirmCourseDeletion',
    ];

    public function confirmCourseDeletion($data)
    {
        $this->delete_course_id = $data['course_id'];
        $this->dispatch('open-modal', 'confirm-course-deletion');
    }

    public function deleteCourse()
    {
        if ($this->delete_course_id) {
            $course = Course::findOrFail($this->delete_course_id);
            $course->delete();

            $this->delete_course_id = null;
            $this->dispatch('close-modal', 'confirm-course-deletion');
            $this->dispatch('notify', type: 'success', message: 'course deleted successfully');
        }
    }

    public function render()
    {
        $courses = Course::query()
            ->withCount('specializations')
            ->when($this->search && $this->search_performed, function ($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('title')
            ->paginate(16)
            ->withQueryString();

        $count_courses = Course::count();
        $count_unpublished = Course::where('is_published', false)->count();

        return view('livewire.pages.courses.courses.index', compact('courses', 'count_courses', 'count_unpublished'));
    }
}
