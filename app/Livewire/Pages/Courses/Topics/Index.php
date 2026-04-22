<?php

namespace App\Livewire\Pages\Courses\Topics;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Courses\Specialization;
use App\Models\Courses\Topic;

class Index extends Component
{
    use WithPagination;

    public $specialization;

    public $confirm_topic_deletion = false;
    public ?int $delete_topic_id = null;

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
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('title')
            ->paginate(12)
            ->withQueryString();
    }

    protected $listeners = [
        'confirm-topic-deletion' => 'confirmTopicDeletion',
        'delete-topic' => 'deleteTopic',
    ];

    public function confirmTopicDeletion($data)
    {
        $this->delete_topic_id = $data['id'];
        $this->confirm_topic_deletion = true;
    }

    public function deleteTopic()
    {
        if ($this->delete_topic_id) {
            Topic::findOrFail($this->delete_topic_id)->delete();
            $this->confirm_topic_deletion = false;
            $this->delete_topic_id = null;
            session()->flash('message', 'Topic deleted successfully.');
        }
    }

    public function render()
    {
        $topics = $this->getTopicsProperty();

        return view('livewire.pages.courses.topics.index', compact('topics'));
    }
}
