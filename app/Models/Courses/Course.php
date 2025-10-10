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

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }

    public function isPublished(): bool
    {
        return $this->is_published === true;
    }

    public function getIsPublishedLabelAttribute()
    {
        return $this->is_published ? 'Published' : 'Unpublished';
    }

    public function getImageUrlAttribute()
    {
        $image = $this->attributes['image'] ?? null;

        if ($image && Storage::disk('public')->exists("courses/images/{$image}")) {
            return Storage::url("courses/images/{$image}");
        }

        return null;
    }
}
