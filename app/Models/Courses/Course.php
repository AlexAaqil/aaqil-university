<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Course $course) {
            $course->uuid = (string) Str::uuid();
            $course->slug = Str::slug($course->title);
        });

        static::updating(function ($course) {
            if ($course->isDirty('title')) {
                $course->slug = Str::slug($course->title);
            }
        });

        static::deleting(function (Course $course) {
            if ($course->image && Storage::disk('public')->exists('courses/images/' . $course->image)) {
                Storage::disk('public')->delete('courses/images/' . $course->image);
            }
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'is_published' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)
            ->withPivot(['sort_order'])
            ->orderBy('pivot_sort_order');
    }

    public function isPublished(): bool
    {
        return $this->is_published === true;
    }

    public function getIsPublishedLabelAttribute()
    {
        return $this->is_published ? 'Published' : 'Unpublished';
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->image && Storage::exists($this->image)
        ? Storage::url($this->image)
        : asset('assets/images/default-image.jpg');
    }
}
