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
        });
    }
}
