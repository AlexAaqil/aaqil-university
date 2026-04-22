<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Specialization extends Model
{
    protected $guarded = [];

    /**
     * Attribute casting.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

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

        static::deleting(function (Specialization $specialization) {
            if ($specialization->image && Storage::disk('public')->exists('courses/specializations/' . $specialization->image)) {
                Storage::disk('public')->delete('courses/specializations/' . $specialization->image);
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

    public function isPublished(): bool
    {
        return (bool) $this->is_published;
    }

    public function getIsPublishedLabelAttribute()
    {
        return $this->is_published ? 'Published' : 'Draft';
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
