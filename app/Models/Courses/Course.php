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
            if (empty($course->uuid)) {
                $course->uuid = (string) Str::uuid();
            }
        });

        static::deleting(function (Course $course) {
            if ($course->image && Storage::disk('public')->exists('courses/images/' . $course->image)) {
                Storage::disk('public')->delete('courses/images/' . $course->image);
            }
        });
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)
            ->withPivot(['sort_order'])
            ->orderBy('pivot_sort_order');
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->image && Storage::exists($this->image)
        ? Storage::url($this->image)
        : asset('assets/images/default-image.jpg');
    }
}
