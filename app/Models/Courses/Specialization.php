<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Specialization extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Specialization $specialization) {
            if (empty($specialization->uuid)) {
                $specialization->uuid = (string) Str::uuid();
            }

            if (empty($specialization->slug)) {
                $base_slug = Str::slug($specialization->title);
                $slug = $base_slug;

                $count = 1;
                while (static::where('course_id', $specialization->course_id)->where('slug', $slug)->exists()) {
                    $slug = "{$base_slug}-{$count}";
                    $count++;
                }

                $specialization->slug = $slug;
            }
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('sort_order');
    }

    public function getImageUrlAttribute()
    {
        $image = $this->attributes['image'] ?? null;

        if ($image && Storage::disk('public')->exists("courses/specializations/{$image}")) {
            return Storage::url("courses/specializations/{$image}");
        }

        return null;
    }
}
