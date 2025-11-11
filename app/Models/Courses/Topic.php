<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Topic $topic) {
            if (empty($topic->uuid)) {
                $topic->uuid = (string) Str::uuid();
            }

            if (empty($topic->slug)) {
                // Ensure slug is unique per specialization on create.
                $base_slug = Str::slug($topic->title);
                $slug = $base_slug;

                $count = 1;
                while (static::where('specialization_id', $topic->specialization_id)
                    ->where('slug', $slug)
                    ->exists()) {
                    $slug = "{$base_slug}-{$count}";
                    $count++;
                }

                $topic->slug = $slug;
            }
        });

        static::updating(function (Topic $topic) {
            if ($topic->isDirty('title') || $topic->isDirty('specialization_id')) {
                $base_slug = Str::slug($topic->title);
                $slug = $base_slug;

                $count = 1;
                while (static::where('specialization_id', $topic->specialization_id)
                    ->where('slug', $slug)
                    ->where('id', '!=', $topic->id)
                    ->exists()) {
                    $slug = "{$base_slug}-{$count}";
                    $count++;
                }

                $topic->slug = $slug;
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

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('sort_order');
    }
}
