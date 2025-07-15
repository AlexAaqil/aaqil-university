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
        });
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('ordering');
    }
}
