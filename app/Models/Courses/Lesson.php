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
                $lesson->slug = Str::slug($lesson->title);
            }
        });
    }

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
