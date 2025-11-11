<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lesson extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Lesson $lesson) {
            if (empty($lesson->uuid)) {
                $lesson->uuid = (string) Str::uuid();
            }

            if (empty($lesson->slug)) {
                // Ensure slug is unique per topic on create by appending suffix if needed.
                $base_slug = Str::slug($lesson->title);
                $slug = $base_slug;

                $count = 1;
                while (static::where('topic_id', $lesson->topic_id)
                    ->where('slug', $slug)
                    ->exists()) {
                    $slug = "{$base_slug}-{$count}";
                    $count++;
                }

                $lesson->slug = $slug;
            }
        });

        // Ensure slugs remain unique per topic when updating title or moving topics.
        static::updating(function (Lesson $lesson) {
            // If title or topic_id changed, regenerate slug and disambiguate within the target topic.
            if ($lesson->isDirty('title') || $lesson->isDirty('topic_id')) {
                $base_slug = Str::slug($lesson->title);
                $slug = $base_slug;

                $count = 1;
                while (static::where('topic_id', $lesson->topic_id)
                    ->where('slug', $slug)
                    ->where('id', '!=', $lesson->id)
                    ->exists()) {
                    $slug = "{$base_slug}-{$count}";
                    $count++;
                }

                $lesson->slug = $slug;
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

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
