<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Section $section) {
            if (empty($section->uuid)) {
                $section->uuid = (string) Str::uuid();
            }

            if (empty($section->slug)) {
                // Ensure slug is unique per lesson on create.
                $base_slug = Str::slug($section->title);
                $slug = $base_slug;

                $count = 1;
                while (static::where('lesson_id', $section->lesson_id)
                    ->where('slug', $slug)
                    ->exists()) {
                    $slug = "{$base_slug}-{$count}";
                    $count++;
                }

                $section->slug = $slug;
            }
        });

        static::updating(function (Section $section) {
            if ($section->isDirty('title') || $section->isDirty('lesson_id')) {
                $base_slug = Str::slug($section->title);
                $slug = $base_slug;

                $count = 1;
                while (static::where('lesson_id', $section->lesson_id)
                    ->where('slug', $slug)
                    ->where('id', '!=', $section->id)
                    ->exists()) {
                    $slug = "{$base_slug}-{$count}";
                    $count++;
                }

                $section->slug = $slug;
            }
        });
    }

    /**
     * Attribute casting.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'uuid' => 'string',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
